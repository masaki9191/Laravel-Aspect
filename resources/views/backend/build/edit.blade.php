@extends('backend.layout.app')
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">ビルド管理</div>

                <div class="card-body">
                    <form id="form" name="form" action="{{route('build.update', $build->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">状態</label>
                            <div class="col-sm-4">
                                <input type="checkbox" class="form-check-input" id="state"  name="state"  {{ $build->state == 1 ? "checked" : "" }}>
                                <label class="form-check-label" for="state">募集中</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">名前</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control  @error('name') is-invalid @enderror"  id="name" name="name" value="{{ old('name') ?? $build->name }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">住所</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control  @error('address') is-invalid @enderror"  id="address" name="address" value="{{ old('address') ?? $build->address }}">
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">規模</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control  @error('scale') is-invalid @enderror"  id="scale" name="scale" value="{{ old('scale') ?? $build->scale }}">
                                @error('scale')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">構造</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control  @error('construction') is-invalid @enderror"  id="construction" name="construction" value="{{ old('construction') ?? $build->construction }}">
                                @error('construction')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">室数</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control  @error('room') is-invalid @enderror"  id="room" name="room" value="{{ old('room') ?? $build->room }}">
                                @error('room')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">延床面積</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control  @error('total_area') is-invalid @enderror"  id="total_area" name="total_area" value="{{ old('total_area') ?? $build->total_area }}">
                                @error('total_area')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-1">m<sup>2</sup></div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">賃室面積</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control  @error('rent_area_from') is-invalid @enderror"  id="rent_area_from" name="rent_area_from" value="{{ old('rent_area_from') ?? $build->rent_area_from }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <input type="number" class="form-control  @error('rent_area_to') is-invalid @enderror"  id="rent_area_to" name="rent_area_to" value="{{ old('rent_area_to') ?? $build->rent_area_to }}">
                                @error('rent_area_to')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">竣工</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control  @error('completion') is-invalid @enderror"  id="completion" name="completion" value="{{ old('completion') ?? $build->completion }}">
                                @error('room')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">Sales Point</label>
                            <div class="col-sm-4">
                                <textarea class="form-control  @error('point') is-invalid @enderror"  id="point" name="point" >{{ old('point') ?? $build->point }}</textarea>
                                @error('point')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-sm-2">基本写真</label>
                            <div class="col-sm-8">
                                <input type="file"  accept="image/*" name="main_photo" id="main_photo" class="  @error('main_photo') is-invalid @enderror"  onchange="loadFile(event, 'main_photo')" style="display: none;">
                                <label for="main_photo" class="btn btn-primary" >ファイルを選ぶ</label>
                                <img id="main_photo_output" name="main_photo_output" src="{{ $build->photo('main_photo') != null? $build->photo('main_photo')->getUrl() : '' }}" class="p-1" style="border: 1px solid rgba(0,0,0,0.12);width:100%"/>
                                @error('main_photo')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">写真</label>
                            <div class="col-sm-10">
                                <div class="needsclick dropzone  @error('photos') is-invalid @enderror" id="photos-dropzone">
                                    @error('photos')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-primary" id="saveBtn" data-toggle="modal" data-target="#confirmModal">登録</button>
                            <a href="{{ route('build.index') }}" class="btn btn-primary">戻る</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="confirmModal" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div class="py-4">上書き更新しますか？</div>
                <div class="">
                    <button type="button" class="btn btn-primary mr-2" id="okBtn">はい</button>
                    <button type="button" class="btn btn-primary ml-2" data-dismiss="modal">いいえ</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script>
    var loadFile = function(event,prefix) {
        var image = document.getElementById(prefix+'_output');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
    $(document).ready(function() {
        $("#okBtn").click(function(){
            document.form.submit();
        });
    });
</script>
<script>
    var uploadedPhotosMap = {}
    Dropzone.options.photosDropzone = {
            url: "{{ route('build.media') }}",
            maxFilesize: 2, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            addRemoveLinks: true,
            headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
            size: 2,
            width: 4096,
            height: 4096
        },
        success: function (file, response) {
            $('form').append('<input type="hidden" name="photos[]" value="' + response.name + '">')
            uploadedPhotosMap[file.name] = response.name
        },
        removedfile: function (file) {
            console.log(file)
            file.previewElement.remove()
            var name = ''
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name
            } else {
                name = uploadedPhotosMap[file.name]
            }
            $('form').find('input[name="photos[]"][value="' + name + '"]').remove()
        },
        init: function () {
            @if(isset($build) && $build->photos)
                @foreach($build->photos as $key => $media)
                    var file = @json($media);
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="photos[]" value="' + file.file_name + '">')
                @endforeach
                for (var i in files) {
                    var file = files[i]

                }
            @endif
        },
        error: function (file, response) {
            if ($.type(response) === 'string') {
                var message = response //dropzone sends it's own error messages in string
            } else {
                var message = response.errors.file
            }
            file.previewElement.classList.add('dz-error')
            _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
            _results = []
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                node = _ref[_i]
                _results.push(node.textContent = message)
            }

            return _results
        }
    }
</script>
@endsection
