@extends('layouts.app')

@section('content')
    <div class="header py-7 py-lg-8">
        <div class="container">
            <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-md-6">
                        <h1 class="text-white">{{ __('Xin chào!') }}</h1>
                        <p class="text-lead text-light">
                            {{ __('Vui lòng đăng nhập để có thể truy cập hệ thống.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
