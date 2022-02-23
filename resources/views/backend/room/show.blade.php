@extends('backend.layout.app')

@section('content')
<style>
.imgb{
    width: 100%;
    
}
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">所在階管理</div>

                <div class="card-body">
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">ビルド:</label>
                            <div class="col-sm-4">
                                {{ $room->build->name }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">所在階:</label>
                            <div class="col-sm-8">
                                {{$room->no}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">賃料:</label>
                            <div class="col-sm-8">
                                {{$room->price}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">賃室規模:</label>
                            <div class="col-sm-4">
                                {{$room->rent_size}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">面積:</label>
                            <div class="col-sm-4">
                                {{$room->area}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">設備:</label>
                            <div class="col-sm-10">
                                {{$room->facility}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">Sales Point:</label>
                            <div class="col-sm-10">
                                {{$room->point}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">基本写真</label>
                            <div class="col-sm-4">
                                <img src="{{ $room->photo('design_photo') != null? $room->photo('design_photo')->getUrl() : '' }}" class="imgb">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">ビデオ</label>
                            <div class="col-sm-4">
                                <video width="320" height="240" controls id="video-tag">
                                    <source id="video-source" src="{{ $room->photo('video') != null? $room->photo('video')->getUrl() : '' }}">
                                     Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>
                        <div class="form-group row">
                            @foreach($room->photos as $key => $media)
                            <div class="col-sm-4">
                                <img src="{{ $media->getUrl('') }}" class="imgb">
                            </div>
                            @endforeach
                        </div>
                        <div class="text-center">
                            <a href="{{ route('room.index') }}" class="btn btn-primary">戻る</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
