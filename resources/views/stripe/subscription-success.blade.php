@extends('layouts.app')

@section('content')
<style>
    .success-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }

    .success-card {
        background: white;
        border-radius: 20px;
        padding: 60px;
        max-width: 550px;
        width: 100%;
        text-align: center;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        animation: fadeInUp 0.6s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .success-icon {
        width: 120px;
        height: 120px;
        background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
        box-shadow: 0 15px 40px rgba(39, 174, 96, 0.3);
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% {
            box-shadow: 0 15px 40px rgba(39, 174, 96, 0.3);
        }
        50% {
            box-shadow: 0 15px 50px rgba(39, 174, 96, 0.5);
        }
    }

    .success-icon i {
        font-size: 55px;
        color: white;
    }

    .success-title {
        font-size: 32px;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 15px;
        font-family: 'Ubuntu', sans-serif;
    }

    .success-subtitle {
        font-size: 18px;
        color: #7f8c8d;
        margin-bottom: 30px;
        line-height: 1.6;
    }

    .subscription-details {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 30px;
    }

    .subscription-details h4 {
        font-size: 14px;
        font-weight: 600;
        color: #95a5a6;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 10px;
    }

    .subscription-details .valid-date {
        font-size: 24px;
        font-weight: 700;
        color: #27ae60;
    }

    .redirect-notice {
        background: #e8f5e9;
        border: 1px solid #a5d6a7;
        border-radius: 10px;
        padding: 15px 20px;
        margin-bottom: 25px;
        color: #2e7d32;
        font-size: 14px;
    }

    .redirect-notice i {
        margin-right: 8px;
    }

    .btn-dashboard {
        background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        color: white;
        border: none;
        padding: 16px 45px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-block;
        text-decoration: none;
        box-shadow: 0 8px 25px rgba(231, 76, 60, 0.3);
    }

    .btn-dashboard:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(231, 76, 60, 0.4);
        color: white;
        text-decoration: none;
    }

    .btn-dashboard i {
        margin-right: 8px;
    }

    @media (max-width: 576px) {
        .success-card {
            padding: 40px 25px;
        }

        .success-title {
            font-size: 26px;
        }

        .subscription-details .valid-date {
            font-size: 20px;
        }
    }
</style>

<div class="success-container">
    <div class="success-card">
        <div class="success-icon">
            <i class="fa fa-check"></i>
        </div>

        <h2 class="success-title">Payment Successful!</h2>

        <p class="success-subtitle">
            Thank you, {{ $user->name }}! Your premium subscription is now active.
        </p>

        <div class="subscription-details">
            <h4>Subscription Valid Until</h4>
            <span class="valid-date">{{ $validTill }}</span>
        </div>

        <div class="redirect-notice">
            <i class="fa fa-clock-o"></i>
            You will be redirected to the dashboard in <span id="countdown">5</span> seconds...
        </div>

        <a href="{{ route('dashboard') }}" class="btn-dashboard">
            <i class="fa fa-home"></i> Go to Dashboard Now
        </a>
    </div>
</div>

<script>
    // Countdown and redirect
    let seconds = 5;
    const countdownEl = document.getElementById('countdown');
    
    const interval = setInterval(function() {
        seconds--;
        countdownEl.textContent = seconds;
        
        if (seconds <= 0) {
            clearInterval(interval);
            window.location.href = "{{ route('dashboard') }}";
        }
    }, 1000);
</script>
@endsection
