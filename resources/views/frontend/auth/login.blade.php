@extends('frontend.layout.auth')
@section('content')
<div class="login_ttl">仲介会社様向け<br>管理物件アーカイブ</div>

<section class="login-page">
    <div class="form">
        <form method="POST" action="{{ route('frontend.auth.login') }}" class="login-form">
            @csrf
            @error('error')
            <div class="error">{{ $message }}</div>
            @enderror
            <p class="message">Username</p>
            <input type="text" placeholder="" id="userid" name="userid" />
            <p class="message">Password</p>
            <input type="password" placeholder=""  id="password" name="password"  />
            <button>login</button>
        </form>
    </div>
</section>
@endsection