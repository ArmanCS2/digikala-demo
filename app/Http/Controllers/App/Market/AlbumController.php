<?php

namespace App\Http\Controllers\App\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Album;
use function view;

class AlbumController extends Controller
{
    public function albums()
    {
        $albums = Album::where('status', 1)->orderBy('ordering')->paginate(15);
        return view('app.market.albums', compact('albums'));
    }
}
