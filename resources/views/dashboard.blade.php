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

@if (session('success') || session('login_success') || request()->query('verified'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let title = 'Success!';
            let text = '';
            
            @if (session('success'))
                text = "{{ session('success') }}";
            @elseif (session('login_success'))
                title = 'Login Successful!';
                text = "{{ session('login_success') }}";
            @elseif (request()->query('verified'))
                title = 'Email Verified!';
                text = 'Your email has been verified successfully! Welcome to Grace Circle Christian Dating.';
            @endif

            Swal.fire({
                icon: 'success',
                title: title,
                text: text,
                showConfirmButton: true,
                confirmButtonColor: '#28a745',
                timer: 5000,
                timerProgressBar: true,
                width: '600px',
                padding: '3em',
                color: '#2f3c44',
                background: '#fff',
                backdrop: `rgba(0,123,0,0.4)`
            });

            // Remove the verified parameter from URL
            if (window.location.search.includes('verified')) {
                window.history.replaceState({}, document.title, window.location.pathname);
            }
        });
    </script>
@endif
@endsection
