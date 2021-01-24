@extends('layouts.app', ['page' => __('Thông tin tài khoản'), 'pageSlug' => 'profile'])

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Thay đổi thông tin') }}</h5>
                </div>
                <form method="post" action="{{ route('profile.update') }}" autocomplete="off">
                    <div class="card-body">
                            @csrf
                            @method('put')

                            @include('alerts.success')

                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label>{{ __('Tên') }}</label>
                                <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', auth()->user()->name) }}">
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label>{{ __('Email') }}</label>
                                <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email address') }}" value="{{ old('email', auth()->user()->email) }}">
                                @include('alerts.feedback', ['field' => 'email'])
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ __('Lưu') }}</button>
                    </div>
                </form>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Mật khẩu') }}</h5>
                </div>
                <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
                    <div class="card-body">
                        @csrf
                        @method('put')

                        @include('alerts.success', ['key' => 'password_status'])

                        <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                            <label>{{ __('Mật khẩu hiện tại') }}</label>
                            <input type="password" name="old_password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Current Password') }}" value="" required>
                            @include('alerts.feedback', ['field' => 'old_password'])
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <label>{{ __('Mật khẩu mới') }}</label>
                            <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" value="" required>
                            @include('alerts.feedback', ['field' => 'password'])
                        </div>
                        <div class="form-group">
                            <label>{{ __('Xác nhận mật khẩu mới') }}</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Confirm New Password') }}" value="" required>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ __('Lưu mật khẩu') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-user">
                <div class="card-body">
                    <p class="card-text">
                        <div class="author">
                            <div class="block block-one"></div>
                            <div class="block block-two"></div>
                            <div class="block block-three"></div>
                            <div class="block block-four"></div>
                            <a href="#">
                                <img class="avatar" src="data:image/jpeg;base64,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" alt="">
                                {{-- <h5 class="title">{{ auth()->user()->name }}</h5> --}}
                            </a>
                            <p class="description">
                                <b> {{ __('THÔNG TIN LIÊN HỆ') }}</b>

                            </p>
                        </div>
                    </p>
                    <div class="card-description">
                        {{ __('Vui lòng liên hệ với chúng tôi nếu bạn gặp trục trặc về kỹ thuật.') }}
                    </div>
                </div>
                <div class="card-footer">
                    <div class="button-container">
                        <button class="btn btn-icon btn-round btn-facebook">
                            <i class="fab fa-facebook"></i>
                        </button>
                        <button class="btn btn-icon btn-round btn-twitter">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <button class="btn btn-icon btn-round btn-google">
                            <i class="fab fa-google-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
