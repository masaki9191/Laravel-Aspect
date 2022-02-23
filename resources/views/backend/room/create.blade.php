@extends('backend.layout.app')
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">所在階管理</div>

                <div class="card-body">
                    <form id="form" name="form" action="{{route('room.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">ビルド</label>
                            <div class="col-sm-4">
                                <select class="form-control  @error('build_id') is-invalid @enderror"  id="build_id" name="build_id">
                                @foreach($builds as $key => $value)
                                    <option value="{{$value['id']}}">{{$value['name']}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">所在階</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control  @error('no') is-invalid @enderror"  id="no" name="no" value="{{ old('no') }}">
                                @error('no')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">賃料</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control  @error('price') is-invalid @enderror"  id="price" name="price" value="{{ old('price') }}">
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">賃室規模</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control  @error('rent_size') is-invalid @enderror"  id="rent_size" name="rent_size" value="{{ old('rent_size') }}">
                                @error('rent_size')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">面積</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control  @error('area') is-invalid @enderror"  id="area" name="area" value="{{ old('area') }}">
                                @error('area')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">設備</label>
                            <div class="col-sm-10">
                                <textarea class="form-control  @error('facility') is-invalid @enderror"  id="facility" name="facility" >{{ old('facility') }}</textarea>
                                @error('facility')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-2">Sales Point</label>
                            <div class="col-sm-10">
                                <textarea class="form-control  @error('point') is-invalid @enderror"  id="point" name="point" >{{ old('point') }}</textarea>
                                @error('point')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-sm-2">構造の写真</label>
                            <div class="col-sm-8">
                                <input type="file"  accept="image/*" name="design_photo" id="design_photo" class="  @error('design_photo') is-invalid @enderror"  onchange="loadFile(event, 'design_photo')" style="display: none;">
                                <label for="design_photo" class="btn btn-primary" >ファイルを選ぶ</label>
                                <img id="design_photo_output" name="design_photo_output" src="" class="p-1" style="border: 1px solid rgba(0,0,0,0.12);width:100%"/>
                                @error('design_photo')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2">ビデオ</label>
                            <div class="col-sm-8">
                                <input type="file"  accept="video/*" name="video" id="video" class="  @error('video') is-invalid @enderror"  onchange="loadVideoFile(event, 'video')" style="display: none;">
                                <label for="video" class="btn btn-primary" >ファイルを選ぶ</label>
                                <video width="320" height="240" controls id="video-tag">
                                      <source id="video-source" src="splashVideo">
                                      Your browser does not support the video tag.
                                </video>
                                @error('video')
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
                <div class="py-4">登録しますか？</div>
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
    var loadVideoFile = function(event,prefix) {
        var videoSrc = document.getElementById("video-source");
        var videoTag = document.getElementById("video-tag");
        if (event.target.files && event.target.files[0]) {
            var reader = new FileReader();
        
            reader.onload = function(e) {
              videoSrc.src = e.target.result
              videoTag.load()
            }.bind(this)
        
            reader.readAsDataURL(event.target.files[0]);
        }
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
        url: "{{ route('room.media') }}",
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
            @if(isset($gallery) && $gallery->photos)
                var files =
                    {!! json_encode($gallery->photos) !!}
                    for (var i in files) {
                    var file = files[i]
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="photos[]" value="' + file.file_name + '">')
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
