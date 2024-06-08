<?php

namespace App\Http\Controllers\App\Content;

use App\Http\Controllers\Controller;
use App\Models\Content\Video;

class VideoController extends Controller
{
    public function videos()
    {
        $videos = Video::where('status', 1)->orderBy('ordering')->paginate(15);
        return view('app.content.videos', compact('videos'));
    }
}
