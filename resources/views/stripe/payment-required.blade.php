@extends('layouts.app')

@section('content')
<style>
    .payment-required-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.85);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .payment-modal {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        border-radius: 20px;
        padding: 50px;
        max-width: 500px;
        width: 90%;
        text-align: center;
        box-shadow: 0 25px 80px rgba(0, 0, 0, 0.4);
        animation: modalSlideIn 0.5s ease-out;
    }

    @keyframes modalSlideIn {
        from {
            opacity: 0;
            transform: translateY(-50px) scale(0.9);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .payment-icon {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
        box-shadow: 0 10px 30px rgba(231, 76, 60, 0.3);
    }

    .payment-icon i {
        font-size: 45px;
        color: white;
    }

    .payment-title {
        font-size: 28px;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 15px;
        font-family: 'Ubuntu', sans-serif;
    }

    .payment-subtitle {
        font-size: 16px;
        color: #7f8c8d;
        margin-bottom: 30px;
        line-height: 1.6;
    }

    .payment-info-box {
        background: #fff3cd;
        border: 1px solid #ffc107;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 30px;
    }

    .payment-info-box p {
        margin: 0;
        color: #856404;
        font-size: 14px;
    }

    .payment-info-box strong {
        color: #e74c3c;
    }

    .payment-price {
        font-size: 42px;
        font-weight: 700;
        color: #27ae60;
        margin-bottom: 10px;
    }

    .payment-price-subtitle {
        font-size: 14px;
        color: #95a5a6;
        margin-bottom: 30px;
    }

    .btn-pay-now {
        background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
        color: white;
        border: none;
        padding: 18px 50px;
        font-size: 18px;
        font-weight: 600;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-block;
        text-decoration: none;
        box-shadow: 0 8px 25px rgba(39, 174, 96, 0.3);
    }

    .btn-pay-now:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(39, 174, 96, 0.4);
        color: white;
        text-decoration: none;
    }

    .btn-pay-now i {
        margin-right: 10px;
    }

    .logout-link {
        display: block;
        margin-top: 25px;
        color: #95a5a6;
        font-size: 14px;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .logout-link:hover {
        color: #e74c3c;
        text-decoration: none;
    }

    .secure-badge {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 25px;
        color: #95a5a6;
        font-size: 12px;
    }

    .secure-badge i {
        color: #27ae60;
    }

    @media (max-width: 576px) {
        .payment-modal {
            padding: 30px 20px;
            margin: 20px;
        }

        .payment-title {
            font-size: 22px;
        }

        .payment-price {
            font-size: 36px;
        }

        .btn-pay-now {
            padding: 15px 40px;
            font-size: 16px;
        }
    }
</style>

<div class="payment-required-overlay">
    <div class="payment-modal">
        <div class="payment-icon">
            <i class="fa fa-lock"></i>
        </div>

        <h2 class="payment-title">
            @if($isTrial)
                Your Free Trial Has Ended
            @else
                Subscription Required
            @endif
        </h2>

        <p class="payment-subtitle">
            @if($isTrial)
                Your {{ \App\Models\Payment::TRIAL_PERIOD_DAYS }}-day free trial has expired. 
                Subscribe now to continue enjoying Grace Circle's premium features!
            @else
                Your subscription has expired {{ $daysSinceExpiry }} days ago. 
                Please renew to regain access to your dashboard.
            @endif
        </p>

        <div class="payment-info-box">
            <p>
                <i class="fa fa-info-circle" style="margin-right: 5px;"></i>
                Your subscription expired <strong>{{ $daysSinceExpiry }} days ago</strong>. 
                Access is blocked after a 3-day grace period.
            </p>
        </div>

        <div class="payment-price">
            ${{ $subscriptionPrice }}
        </div>
        <p class="payment-price-subtitle">
            30-Day Premium Membership
        </p>

        <form action="{{ route('subscription.checkout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-pay-now">
                <i class="fa fa-credit-card"></i> Pay Now
            </button>
        </form>

        <div class="secure-badge">
            <i class="fa fa-shield"></i>
            <span>Secure payment powered by Stripe</span>
        </div>

        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="logout-link" style="background: none; border: none; cursor: pointer;">
                <i class="fa fa-sign-out"></i> Logout
            </button>
        </form>

        @if(session('error'))
            <div style="margin-top: 20px; padding: 15px; background: #ffebee; border-radius: 8px; color: #c62828;">
                {{ session('error') }}
            </div>
        @endif
    </div>
</div>
@endsection
