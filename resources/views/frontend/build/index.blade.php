@extends('frontend.layout.app')
@section('content')
<section class="hero" id="hero">
    <h2 class="hero_header"><img src="{{asset('assets/frontend/images/hero.png')}}" alt="APEST 取扱管理物件" /></h2>
</section>
<!-- About Section -->
<section class="about" id="about">
    <div class="text_column">
        <select class="form-control  @error('build_id') is-invalid @enderror" id="build_id" name="build_id"
            placeholder="物件名で検索" onchange="fnBuild()">
            @foreach($builds as $key => $value)
            <option value="{{$value['id']}}">{{$value['name']}}</option>
            @endforeach
        </select>
        <span><i class="fa fa-angle-down fa-lg" aria-hidden="true"></i></span>
    </div>
</section>

<section class="info" id="info">
    <div class="text_info">掲載物件数 <span class="text_quantity">{{$count}}</span>件</div>
    <br />
</section>
<section class="update" id="update">
    <div class="text_update">（最終更新日2021年3月3日）</div>
</section>

<div class="flexcontent">
    <div class="flexbox">
        @forelse($builds as $build)
        <div class="flex_item">
            <div class="relative">
                <img src="{{ $build->photo('main_photo') != null? $build->photo('main_photo')->getUrl() : '' }}"
                    alt="フレア武蔵" class="flex_img" />
                @if($build->state == 1)
                <img src="{{asset('assets/frontend/images/recruitment.png')}}" class="absolute" />
                @endif
            </div>
            <div class="bldg">{{$build->name}}</div>
            <div class="address">&#40;{{$build->address}}&#41;</div>
            <div class="viewmore right"><a href="/build-detail/{{$build->id}}"><img
                        src="{{asset('assets/frontend/images/viewmore.png')}}" /></a></div>
        </div>
        @empty
        資料がありません。
        @endforelse
    </div>
</div>    
<script type="text/javascript">
function fnBuild() {
    var build_id = document.getElementById("build_id").value;
    location.href = "/build-detail/" + build_id;
}
</script>
@endsection