<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Ilustrasi;
use Illuminate\Http\Request;
use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\X264;
use Illuminate\Support\Str;

class VideoController extends Controller
{
  public function show()
  {
    $video = Video::all();
    return view('user.show', compact('video'));
  }


  public function index()
  {
    $videos = Video::all();
    $ilustrasi = Ilustrasi::first() ?? new Ilustrasi();
    return view('admin.videos.index', compact('videos', 'ilustrasi'));
  }

  public function create()
  {
    return view('admin.videos.create');
  }


  public function edit($id)
  {
    $video = Video::findOrFail($id);
    return view('admin.videos.edit', compact('video'));
  }

  public function store(Request $request)
{
    $request->validate([
      'title' => 'required|string|max:255',
      'video_file' => 'required|file', // Changed from 'original_name' to 'video_file'
      'description' => 'nullable|string',
    ]);

    $video = new Video();
    $video->title = $request->title;
    $video->description = $request->description;

    if ($request->hasFile('video_file')) {
      try {
        $file = $request->file('video_file');
        $originalName = $file->getClientOriginalName();
        $video->original_name = $originalName;

        $fileName = time() . '_' . $originalName;
        $path = $file->storeAs('videos', $fileName, 'public');
        $video->path = $path;
      } catch (\Exception $e) {
        return redirect()->back()->withErrors(['video_file' => 'Failed to upload video: ' . $e->getMessage()]);
      }
    }

    $video->save(); // Save video first to get an ID
    return redirect()->route('videos.index')->with([
      'message' => 'Video successfully uploaded!',
      'alert-type' => 'success',
    ]);
}


public function update(Request $request, Video $video)
{
    $request->validate([
      'title' => 'required|string|max:255',
      'video_file' => 'nullable|file', // Changed from 'original_name' to 'video_file'
      'description' => 'nullable|string',
    ]);

    $video->title = $request->title;
    $video->description = $request->description;

    if ($request->hasFile('video_file')) {
      try {
        $file = $request->file('video_file');
        $originalName = $file->getClientOriginalName();
        $video->original_name = $originalName;

        $fileName = time() . '_' . $originalName;
        $path = $file->storeAs('videos', $fileName, 'public');
        $video->path = $path;
      } catch (\Exception $e) {
        return redirect()->back()->withErrors(['video_file' => 'Failed to upload video: ' . $e->getMessage()]);
      }
    }

    $video->save();

    return redirect()->route('videos.index')->with([
      'message' => 'Video successfully updated!',
      'alert-type' => 'success'
    ]);
}



  public function download(Video $video)
  {
    $filePath = storage_path('app/public/' . $video->path);

    if (!file_exists($filePath)) {
      return redirect()->back()->with([
        'message' => 'Video file not found!',
        'alert-type' => 'danger'
      ]);
    }

    return response()->download($filePath, $video->original_name);
  }


  public function delete(Video $video)
  {
    $video->delete();

    return redirect()->back()->with([
      'message' => 'Video successfully deleted!',
      'alert-type' => 'danger'
    ]);
  }
}