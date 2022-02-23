<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Build;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\backend\Traits\MediaUploadingTrait;

class BuildController extends Controller
{
    use MediaUploadingTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $builds = Build::latest()->paginate(10);
        return view("backend.build.index", compact('builds'))
        ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.build.create');
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
            'name' => 'required',
            'address' => 'required',
            'scale' => 'required',
            'construction' => 'required',
            'room' => 'required',
            'total_area' => 'required',
            'rent_area_from' => 'required',
            'rent_area_to' => 'required',
            'completion' => 'required',
            'point' => 'required',
            'main_photo' => 'required',
        ]);
        $main_photo = $request->file('main_photo');
        $data = $request->except('_token, main_photo');
        $build = Build::create($data);
        $path = storage_path('tmp/uploads/');
        if($main_photo != null){
            $main_photo_data = $this->storeMedia($main_photo)->getData();
            $build->addMedia($path . $main_photo_data->name)->toMediaCollection('main_photo');
        }
        
        foreach ($request->input('photos', []) as $file) {
            $build->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('photos');
        }

        return redirect()->route('build.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $build = Build::where("id", $id)->first();
        return view('backend.build.show', compact('build'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $build = Build::where("id", $id)->first();
        return view('backend.build.edit', compact('build'));
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
        $build = Build::where("id", $id)->first();
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'scale' => 'required',
            'construction' => 'required',
            'room' => 'required',
            'total_area' => 'required',
            'rent_area_from' => 'required',
            'rent_area_to' => 'required',
            'completion' => 'required',
            'point' => 'required',
        ]);
        $main_photo = $request->file('main_photo');
        $state = 0;
        if($request->input('state') == "on") {
            $state = 1;
        }
        $data = $request->except('_token, main_photo, state');
        $data['state'] = $state;
        $path = storage_path('tmp/uploads/');                
        $build->update($data);
        
        if($main_photo != null){
            if ($build->photo('main_photo') != null)
            {
                $media = $build->getMedia('main_photo')->first();
                $media->delete();
            }
            $main_photo_data = $this->storeMedia($main_photo)->getData();
            $build->addMedia($path . $main_photo_data->name)->toMediaCollection('main_photo');
        }        
        if (count($build->photos) > 0) {
            foreach ($build->photos as $media) {
                if (!in_array($media->file_name, $request->input('photos', []))) {
                    $media->delete();
                }
            }
        }
        $media = $build->photos->pluck('file_name')->toArray();

        foreach ($request->input('photos', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $build->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('photos');
            }
        }
        
        return redirect()->route('build.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $build = build::where("id", $id)->first();
        if ($build->main_photo != null)
        {
            $media = $build->getMedia('main_photo')->first();
            $media->delete();
        }
        if (count($build->photos) > 0) {
            foreach ($build->photos as $media) {
                $media->delete();
            }
        }
        $build->delete();
        return redirect()->route('build.index');
    }
}
