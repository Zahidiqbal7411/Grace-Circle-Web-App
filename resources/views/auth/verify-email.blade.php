@php
    $isSyncTab = request()->query('sync') == 1 || (isset($isSuccess) && $isSuccess);
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verify Email - Grace Circle</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            padding: 20px;
            overflow: hidden;
        }
        .container { position: relative; width: 100%; max-width: 550px; }
        .card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 40px;
            padding: 60px 40px;
            text-align: center;
            box-shadow: 0 40px 100px rgba(0,0,0,0.5);
            position: relative;
            z-index: 10;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .icon-box {
            width: 120px; height: 120px;
            background: linear-gradient(135deg, #f0f2f5 0%, #e2e8f0 100%);
            border-radius: 35px; margin: 0 auto 40px;
            display: flex; align-items: center; justify-content: center;
            color: #764ba2; font-size: 50px;
        }
        .success-glow { animation: success-pulse 2s infinite; color: #48bb78 !important; }
        @keyframes success-pulse {
            0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(72, 187, 120, 0.4); }
            70% { transform: scale(1.05); box-shadow: 0 0 0 15px rgba(72, 187, 120, 0); }
            100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(72, 187, 120, 0); }
        }
        h2 { color: #1a202c; margin-bottom: 20px; font-weight: 800; font-size: 32px; }
        p { color: #4a5568; margin-bottom: 40px; line-height: 1.8; font-size: 16px; font-weight: 500; }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white; padding: 20px 40px; border-radius: 25px;
            text-decoration: none; font-weight: 700; border: none; cursor: pointer;
            font-size: 16px; transition: all 0.3s ease;
        }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3); }
        .swal2-popup { border-radius: 30px !important; padding: 2em !important; }
        .swal2-title { font-weight: 800 !important; color: #1a202c !important; }
        .swal2-confirm { border-radius: 15px !important; padding: 12px 35px !important; font-weight: 700 !important; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card" id="statusCard">
            @if($isSyncTab)
                <div class="icon-box success-glow"><i class="fa fa-sync fa-spin"></i></div>
                <h2>Synchronizing...</h2>
                <p>Divine timing! We are updating your registration window now.</p>
            @else
                <div class="icon-box"><i class="fa fa-paper-plane"></i></div>
                <h2>Check Your Inbox</h2>
                <p>We've sent a spiritual key to your email. Click the link inside to verify your account. <b>This window will close automatically.</b></p>
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn-primary">Resend Verification Email</button>
                </form>
            @endif
        </div>
    </div>

    <script>
        const channel = window.BroadcastChannel ? new BroadcastChannel('email_verification') : null;

        function THE_SIMPLE_TRICK() {
            // This is the closure logic for the OLD tab
            const card = document.getElementById('statusCard');
            if (card) {
                card.innerHTML = `
                    <div class="icon-box success-glow"><i class="fa fa-check"></i></div>
                    <h2>Verified!</h2>
                    <p>Redirecting you to the community...</p>
                `;
            }
            // Attempt to close or redirect
            window.open('', '_self', '');
            window.close();
            setTimeout(() => {
                if (!window.closed) {
                   window.location.replace('{{ route("home") }}?verified=1');
                }
            }, 1000);
        }

        @if($isSyncTab)
            // PHASE: NEW TAB (From Gmail)
            // 1. Signal all other tabs
            if (channel) channel.postMessage('verified');
            if (window.localStorage) localStorage.setItem('grace_verify_signal', Date.now().toString());

            // 2. Show Success Modal to User
            window.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                    title: 'Verification Successful!',
                    text: 'Your email has been successfully verified. You can now return to your original registration tab to continue your spiritual journey.',
                    icon: 'success',
                    confirmButtonText: 'Great, take me back!',
                    confirmButtonColor: '#764ba2',
                    allowOutsideClick: false,
                    background: '#fff url(/img/confetti.gif)',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Attempt to close this tab and go back
                        window.open('', '_self', '');
                        window.close();
                        // Final fallback if close fails
                        setTimeout(() => {
                            window.location.href = '{{ route("home") }}?verified=1';
                        }, 500);
                    }
                });
            });
        @else
            // PHASE: OLD TAB (Waiting)
            if (channel) {
                channel.onmessage = (event) => {
                    if (event.data === 'verified') THE_SIMPLE_TRICK();
                };
            }
            window.addEventListener('storage', (e) => {
                if (e.key === 'grace_verify_signal') THE_SIMPLE_TRICK();
            });

            // Polling backup
            setInterval(async () => {
                try {
                    const res = await fetch('{{ route("verification.status") }}');
                    const data = await res.json();
                    if (data.verified) THE_SIMPLE_TRICK();
                } catch(e) {}
            }, 4000);
        @endif
    </script>
</body>
</html>
