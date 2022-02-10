<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Property;
use Illuminate\Support\Arr;

class VideoController extends Controller
{
    public function show(Video $video)
    {   
        // $video = Video::find($video->id)->with('property')->first();
        return view('video.view', ['video' => $video]);
    }

    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'type' => 'required',
            'font_color' => 'required',
            'pop_time' => 'required',
            'font_family' => 'required',
            'background_color' => 'required',
            'position' => 'required'
        ]);

        if ($request->hasFile('local')) {
            $request->validate([
                'local' => 'required|mimes:mp4'
            ]);
            $file = $request->file('local');
            $name = $file->hashName(); // Generate a unique, random name...
            $extension = $file->extension();
            $move = $file->move($path = 'videos', $newName = $name.'.'.$extension);
            $url = $path.'/'.$newName;
        }

        if ($request->type == 'url') {
            $link = explode('/', $request->url);
            // $videoCode = Arr::last($link);
            $videoCode = array_pop($link);
        }
        $video = Video::create([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'file_url' => $request->type == 'url' ? $videoCode : $url,
        ]);

        $property = Property::create([
            'video_id' => $video->id,
            'font_color' => $request->font_color,
            'font_family' => $request->font_family,
            'pop_time' => $request->pop_time,
            'background_color' => $request->background_color,
            'position' => $request->position,
            'custom' => $request->position == 'custom' ? $request->custom : null,
        ]);
        toast('Video upload and created successfully!','success');
        return redirect()->back(); 
    }
}
