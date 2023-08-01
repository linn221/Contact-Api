<?php

namespace App\Http\Controllers;

use App\Http\Resources\FavouriteResource;
use App\Models\Favourite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $favourites = Auth::user()->favourites;
        return FavouriteResource::collection($favourites);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'contact_id' => 'required|exists:contacts,id'
        ]);

        $fav = Favourite::firstOrCreate([
            'user_id' => Auth::id(),
            'contact_id' => $request->contact_id
        ]);
        return response()->json($fav);
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $favourite = Favourite::find($id);
        if (is_null($favourite)) {
            return response()->json([
                'message' => 'favourite not found'
            ], 404);
        }
        $favourite->delete();
        return response()->json([
            'message' => 'favourite deleted'
        ], 204);
    }

    public function reset()
    {
        Auth()->user()->favourites()->delete();
        return response()->json([
            'message' => 'all favourites removed'
        ], 204);
    }
}
