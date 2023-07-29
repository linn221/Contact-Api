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
        $favourite->delete();
        return FavouriteResource::collection(Auth::user()->favourites);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

}
