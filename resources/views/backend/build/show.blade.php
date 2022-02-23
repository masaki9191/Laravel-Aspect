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
                <div class="card-header">ビルド管理</div>

                <div class="card-body">
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">状態:</label>
                            <div class="col-sm-4">
                                {{ $build->state == 0 ? "" : "募集中" }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">名前:</label>
                            <div class="col-sm-4">
                                {{$build->name}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">住所:</label>
                            <div class="col-sm-4">
                                {{$build->address}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">規模:</label>
                            <div class="col-sm-4">
                                {{$build->scale}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">構造:</label>
                            <div class="col-sm-4">
                                {{$build->construction}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">室数:</label>
                            <div class="col-sm-4">
                                {{$build->room}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">延床面積:</label>
                            <div class="col-sm-4">
                                {{$build->total_area}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">室数:</label>
                            <div class="col-sm-4">
                                {{$build->room}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">賃室面積:</label>
                            <div class="col-sm-4">
                                {{$build->room}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">賃室面積:</label>
                            <div class="col-sm-4">
                                {{$build->rent_area_from}} ~ {{$build->rent_area_to}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">completion:</label>
                            <div class="col-sm-4">
                                {{$build->completion}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">Sales Point:</label>
                            <div class="col-sm-4">
                                {{$build->point}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">基本写真</label>
                            <div class="col-sm-4">
                                <img src="{{ $build->photo('main_photo') != null? $build->photo('main_photo')->getUrl() : '' }}" class="imgb">
                            </div>
                        </div>
                        <div class="form-group row">
                            @foreach($build->photos as $key => $media)
                            <div class="col-sm-4">
                                <img src="{{ $media->getUrl('') }}" class="imgb">
                            </div>
                            @endforeach
                        </div>
                        <div class="text-center">
                            <a href="{{ route('build.index') }}" class="btn btn-primary">戻る</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
