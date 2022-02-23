@extends('backend.layout.auth')
@section('content')
<style>
.login-center {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 75vh;
}
</style>
<div class="container login-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('backend.auth.login') }}">
                    @csrf
                    @error('error')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group row">
                        <label for="userid" class="col-md-4 col-form-label text-md-right">{{ __('ID') }}</label>

                        <div class="col-md-6">
                            <input id="userid" type="text" class="form-control @error('userid') is-invalid @enderror"
                                name="userid" value="{{ old('userid') }}" required autocomplete="userid" autofocus>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('パスワード') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">

                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('ログイン') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection