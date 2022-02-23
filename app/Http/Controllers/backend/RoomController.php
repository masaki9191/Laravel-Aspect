<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Build;
use App\Models\Room;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\backend\Traits\MediaUploadingTrait;

class RoomController extends Controller
{
    use MediaUploadingTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::latest()->paginate(10);
        return view("backend.room.index", compact('rooms'))
        ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $builds = Build::all();
        return view('backend.room.create', compact('builds'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'build_id' => 'required',
            'no' => 'required',
            'price' => 'required',
            'rent_size' => 'required',
            'area' => 'required',
            'facility' => 'required',
            'point' => 'required',
            'design_photo' => 'required',
            'video' => 'required',
        ]);
        $design_photo = $request->file('design_photo');
        $video = $request->file('video');
        $path = storage_path('tmp/uploads/');
        $data = $request->except('_token, design_photo', 'video');
        $room = Room::create($data);
        if($design_photo != null){
            $design_photo_data = $this->storeMedia($design_photo)->getData();
            $room->addMedia($path . $design_photo_data->name)->toMediaCollection('design_photo');
        }
        
        if($video != null){
            $video_data = $this->storeMedia($video)->getData();
            $room->addMedia($path . $video_data->name)->toMediaCollection('video');
        }
        
        foreach ($request->input('photos', []) as $file) {
            $room->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('photos');
        }

        return redirect()->route('room.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room = Room::where("id", $id)->first();
        return view('backend.room.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $builds = Build::all();
        $room = Room::where("id", $id)->first();
        return view('backend.room.edit', compact('room'), compact('builds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $room = Room::where("id", $id)->first();
        $request->validate([
            'build_id' => 'required',
            'no' => 'required',
            'price' => 'required',
            'rent_size' => 'required',
            'area' => 'required',
            'facility' => 'required',
            'point' => 'required',
        ]);
        $design_photo = $request->file('design_photo');
        $video = $request->file('video');
        $data = $request->except('_token, design_photo, video');
        $path = storage_path('tmp/uploads/');                
        $room->update($data);
        
        if($design_photo != null){
            if ($room->photo('design_photo') != null)
            {
                $media = $room->getMedia('design_photo')->first();
                $media->delete();
            }
            $design_photo_data = $this->storeMedia($design_photo)->getData();
            $room->addMedia($path . $design_photo_data->name)->toMediaCollection('design_photo');
        } 
        if($video != null){
            if ($room->photo('video') != null)
            {
                $media = $room->getMedia('video')->first();
                $media->delete();
            }
            $video_data = $this->storeMedia($video)->getData();
            $room->addMedia($path . $video_data->name)->toMediaCollection('video');
        } 
        
        if (count($room->photos) > 0) {
            foreach ($room->photos as $media) {
                if (!in_array($media->file_name, $request->input('photos', []))) {
                    $media->delete();
                }
            }
        }
        $media = $room->photos->pluck('file_name')->toArray();

        foreach ($request->input('photos', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $room->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('photos');
            }
        }
        
        return redirect()->route('room.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
