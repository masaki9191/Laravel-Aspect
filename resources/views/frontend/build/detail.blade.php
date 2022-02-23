@extends('frontend.layout.app')
@section('content')
<section class="detail_box">
    <div class="detail_column_l detail_relative">
        <img src="{{ $build->photo('main_photo') != null? $build->photo('main_photo')->getUrl() : '' }}" />
        <img src="{{asset('assets/frontend/images/recruitment.png')}}" class="detail_absolute" />
    </div>
    <div class="detail_column_r">
        <div class="detail_column_r_ttl">{{$build->name}}</div>

        <div class="sns_box">
            <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button"
                data-show-count="false">Tweet</a>
            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            <div class="line-it-button" data-lang="ja" data-type="share-a" data-ver="3" data-url="https://apest.co.jp/"
                data-color="default" data-size="small" data-count="false" style="display: none"></div>
            <script src="https://www.line-website.com/social-plugins/js/thirdparty/loader.min.js" async="async"
                defer="defer"></script>
            <img src="{{asset('assets/frontend/images/yt_logo_pms_light.svg')}}" alt="youtube" height="20" /><img
                src="{{asset('assets/frontend/images/Instagram_AppIcon_Aug2017.png')}}" width="20" height="20" alt="Instagram" class="item_space" />
        </div>

        <dl class="detail_info">
            <dt>住所</dt>
            <dd>{{$build->address}}</dd>
            <dt>規模</dt>
            <dd>{{$build->scale}}</dd>
            <dt>構造</dt>
            <dd>{{$build->construction}}</dd>
            <dt>室数</dt>
            <dd>{{$build->room}}</dd>
            <dt>延床面積</dt>
            <dd>{{$build->total_area}}m<sup>2</sup>(<?php echo round($build->total_area / 3, 2)?>坪)</dd>
            <dt>賃室面積</dt>
            <dd>{{$build->rent_area_from}}m<sup>2</sup> ~ {{$build->rent_area_to}}m<sup>2</sup></dd>
            <dt>竣工</dt>
            <dd>{{$build->completion}}</dd>
        </dl>
    </div>
</section>

<section class="sp_box">
    <div class="sp_column_l">
        <div class="sp_column_l_txt sp_column_l_absolute">Sales Point<span></span></div>
    </div>
    <div class="sp_column_r">
        <p class="sp_column_r_txt_line">
            {{$build->point}}
            セールスポイントセールスポイントセールスポイントセールスポイントセールスポイントセールスポイントセールスポイントセールスポイントセールスポイントセールスポイントセールスポイント。
        </p>
    </div>
</section>

<section class="flexcontent">
    <div class="detail_flexbox">
        @foreach($build->photos as $key => $media)
        <div class="detail_flex_item detail_flex_relative">
            <a href="{{ $media->getUrl('') }}" data-lightbox="sample" data-title=" ">
                <img src="{{ $media->getUrl('') }}" alt="フレア武蔵" class="flex_img" />
                <img src="{{asset('assets/frontend/images/expansion.png')}}" class="detail_flex_absolute" />
            </a>
        </div>
        @endforeach
    </div>
</section>

<section class="result inquiry">
    <div class="btn01">
        <a href="/">
            <div class="effect"></div>
            <span></span>この物件について問い合わせる
        </a>
    </div>
    <div class="btn02">
        <a href="{{ route('frontend.build.index' )}}">
            <div class="effect"></div>
            <span></span>取扱物件一覧へ戻る
        </a>
    </div>
</section>

<section class="vacancy">
    <div class="vacancy_list">
        <table class="vacancy_table">
            <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>所在階</th>
                    <th>間取り</th>
                    <th>賃料</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($build->rooms as $row)
                <tr>
                    <td><img src="{{asset('assets/frontend/images/vacant.png')}}" alt="空室" /></td>
                    <td>{{$row->no}}号室</td>
                    <td>{{$row->rent_size}}</td>
                    <td>{{$row->price}}</td>
                    <td><a href="/build-detail/{{$build->id}}/{{$row->id}}">物件詳細</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
<!-- About Section -->
@if($room != null)
<div class="alldata">
    <section class="detail_box">
        <div class="detail_column_l detail_relative">
            <img src="{{ $room->photos != null? $room->photos->first()->getUrl() : '' }}" />
            <img src="{{asset('assets/frontend/images/recruitment.png')}}" class="detail_absolute" />
        </div>
        <div class="detail_column_r">
            <div class="detail_column_r_ttl">{{$room->no}}号室</div>
    
            <dl class="detail_info mgt_50">
                <dt>賃室規模</dt>
                <dd>{{$room->rent_size}}</dd>
                <dt>面積</dt>
                <dd>{{$room->area}}m<sup>2</sup></dd>
                <dt>設備</dt>
                <dd>{{$room->facility}}</dd>
            </dl>
        </div>
    </section>
    
    <section class="sp_box">
        <div class="sp_column_l">
            <div class="sp_column_l_txt">Sales Point</div>
        </div>
        <div class="sp_column_r">
            <p class="sp_column_r_txt_line">
                {{$room->point}}
            </p>
        </div>
    </section>
    
    <section class="detail_box_2">
        <div class="detail_box_2_column_l">
            <a href="{{ $room->photo('design_photo') != null? $room->photo('design_photo')->getUrl() : '' }}" data-lightbox="sample" data-title=" ">
            <img src="{{ $room->photo('design_photo') != null? $room->photo('design_photo')->getUrl() : '' }}" /></a>
        </div>
        <div class="detail_box_2_column_r">
            <!-- <img src="{{asset('assets/frontend/images/movie.png')}}" /> -->
            <video width="320" height="240" controls id="video-tag">
                <source id="video-source" src="{{ $room->photo('video') != null? $room->photo('video')->getUrl() : '' }}">
                Your browser does not support the video tag.
            </video>
            <div class="sns_box_2">
                動画を&nbsp;
                <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button"
                    data-show-count="false">Tweet</a>
                <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                <div class="line-it-button" data-lang="ja" data-type="share-a" data-ver="3" data-url="https://apest.co.jp/"
                    data-color="default" data-size="small" data-count="false" style="display: none"></div>
                <script src="https://www.line-website.com/social-plugins/js/thirdparty/loader.min.js" async="async"
                    defer="defer"></script>
            </div>
        </div>
    </section>
    
    <section class="flexcontent">
        <div class="detail_flexbox">
            @foreach($room->photos as $key => $media)
            <div class="detail_flex_item detail_flex_relative">
                <a href="{{ $media->getUrl('') }}" data-lightbox="sample" data-title=" ">
                    <img src="{{ $media->getUrl('') }}" alt="フレア武蔵" class="flex_img" />
                    <img src="{{asset('assets/frontend/images/expansion.png')}}" class="detail_flex_absolute" />
                </a>
            </div>
            @endforeach
        </div>
    </section>
</div>
@endif
<section class="result inquiry">
    <div class="btn01">
        <a href="/">
            <div class="effect"></div>
            <span></span>この物件について問い合わせる
        </a>
    </div>
    <div class="btn02">
        <a href="{{ route('frontend.build.index' )}}">
            <div class="effect"></div>
            <span></span>取扱物件一覧へ戻る
        </a>
    </div>
</section>
@endsection