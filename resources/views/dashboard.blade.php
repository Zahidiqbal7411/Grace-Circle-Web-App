@extends('layouts.app')

@section('content')
<section class="welcome_area">
    <div class="container">
        <div class="welcome_title">
            <h3>{{ __('Dashboard') }}</h3>
            <img src="{{ asset('img/w-title-b.png') }}" alt="">
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="padding: 40px; text-align: center; background: #fff; border: 1px solid #eee; border-radius: 10px; margin-bottom: 50px;">
                    <div class="p-6 text-gray-900" style="font-size: 24px; color: #2f3c44; font-family: 'Ubuntu', sans-serif;">
                        <i class="fa fa-user-circle" style="font-size: 50px; color: #e74c3c; margin-bottom: 20px; display: block;"></i>
                        {{ __("Welcome back, ") }} {{ Auth::user()->name }}!
                        <p style="font-size: 16px; color: #666; margin-top: 10px; line-height: 24px;">
                            {{ __("You're successfully logged into Grace Circle Christian Dating.") }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
