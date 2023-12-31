<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContactDetailResource;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use App\Models\SearchRecord;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{

    // response properties
    // success [ true, false ]
    // message
    // errors
    // data

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::when(request()->has('keyword'), function ($query) {
            $keyword = request()->keyword;
            $query->where('name', 'like', "%$keyword%");

            $search_record = SearchRecord::create([
                'user_id' => Auth::id(),
                'keyword' => $keyword
            ]);
        })
        ->when(request()->query('trashed'), function ($query) {
            $query->withTrashed();
        })
        ->latest("id")->paginate(5)->withQueryString();

        return ContactResource::collection($contacts);
    }

    public function trashedIndex()
    {
        $contacts = Contact::onlyTrashed()
            ->when(request()->has('keyword'), function ($query) {
                $keyword = request()->keyword;
                $query->where('name', 'like', "%$keyword%");
                $search_record = SearchRecord::create([
                    'user_id' => Auth::id(),
                    'keyword' => $keyword
                ]);
            })
            ->latest("id")->paginate(5)->withQueryString();
        return ContactResource::collection($contacts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "country_code" => "required|min:1|max:265",
            "phone_number" => "required"
        ]);

        $contact = Contact::create([
            "name" => $request->name,
            "country_code" => $request->country_code,
            "phone_number" => $request->phone_number,
            "user_id" => Auth::id()
        ]);

        return new ContactDetailResource($contact);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contact = Contact::find($id);
        if (is_null($contact)) {
            return response()->json([
                // "success" => false,
                "message" => "Contact not found",

            ], 404);
        }

        // return response()->json([
        //     "data" => $contact
        // ]);
        return new ContactDetailResource($contact);
    }

    public function trashedShow(string $id)
    {
        $contact = Contact::onlyTrashed()->where('id', $id)->first();
        if (is_null($contact)) {
            return response()->json([
                // "success" => false,
                "message" => "Contact not found",

            ], 404);
        }

        // return response()->json([
        //     "data" => $contact
        // ]);
        return new ContactDetailResource($contact);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name" => "nullable|min:3|max:20",
            "country_code" => "nullable|integer|min:1|max:265",
            "phone_number" => "nullable|min:7|max:15"
        ]);

        $contact = Contact::find($id);
        if (is_null($contact)) {
            return response()->json([
                // "success" => false,
                "message" => "Contact not found",

            ], 404);
        }

        // $contact->update([
        //     "name" => $request->name,
        //     "country_code" => $request->country_code,
        //     "phone_number" => $request->phone_number
        // ]);

        // $contact->update($request->all());

        if ($request->has('name')) {
            $contact->name = $request->name;
        }

        if ($request->has('country_code')) {
            $contact->country_code = $request->country_code;
        }

        if ($request->has('phone_number')) {
            $contact->phone_number = $request->phone_number;
        }

        $contact->update();



        return new ContactDetailResource($contact);
    }

    public function restore(string $id)
    {
        $contact = Contact::onlyTrashed()->where('id', $id)->first();
        if (is_null($contact)) {
            return response()->json([
                // "success" => false,
                "message" => "Contact not found",

            ], 404);
        }

        $contact->restore();

        return new ContactDetailResource($contact);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = Contact::find($id);
        if (is_null($contact)) {
            return response()->json([
                // "success" => false,
                "message" => "Contact not found",

            ], 404);
        }
        $contact->delete();

        // return response()->json([],204);
        return response()->json([
            "message" => "Contact is deleted",
        ], 204);
    }

    public function forceDelete(string $id)
    {
        $contact = Contact::onlyTrashed()->where('id', $id)->first();
        if (is_null($contact)) {
            return response()->json([
                // "success" => false,
                "message" => "Contact not found or not soft deleted",

            ], 404);
        }

        $contact->forceDelete();
        return response()->json([
            "message" => 'Contact has been force deleted!',
        ], 204);
    }

    public function reset()
    {
        $contact = Contact::onlyTrashed()->forceDelete();
        // if (is_null($contact)) {
        //     return response()->json([
        //         // "success" => false,
        //         "message" => "Contact not found or not soft deleted",

        //     ], 404);
        // }

        // $contact->forceDelete();
        return response()->json([
            "message" => 'Trashed contacts have been cleared!',
        ], 204);
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'contacts' => "required|array",
            'contacts.*' => "numeric|exists:contacts,id"
        ]);
        Contact::destroy($request->contacts);
        return response()->json([
            "message" => 'bulked deleted contacts',
        ], 204);
    }

    public function restoreAll()
    {
        Contact::onlyTrashed()->restore();
        return response()->json([
            'message' => 'deleted contacts have been restoered'
        ]);
    }
}
