<?php

namespace App\Http\Controllers;

use App\Http\Requests\FavoriteRequest;
use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function getFavorite(){
        $favorites = Favorite::all();
        return $favorites;
    }
    public function saveFavorite(Favorite $favorite){
        return $favorite;
        // $favorite = new Favorite($request->all());
    }
    public function deleteFavorite(){

    }
}
