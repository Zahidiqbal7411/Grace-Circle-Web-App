@php
    $isSuccess = $isSuccess ?? (session('verified') == 'success');
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $isSuccess ? 'Email Verified' : 'Verify Email' }} - Grace Circle</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Outfit', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: {{ $isSuccess ? 'linear-gradient(135deg, #28a745 0%, #20c997 100%)' : 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)' }};
            transition: background 0.5s ease;
        }
        .card {
            background: white;
            border-radius: 20px;
            padding: 50px;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            max-width: 500px;
            width: 90%;
        }
        .icon {
            width: 80px;
            height: 80px;
            background: #f8f9fa;
            border-radius: 50%;
            margin: 0 auto 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: {{ $isSuccess ? '#28a745' : '#667eea' }};
            font-size: 30px;
        }
        h2 { color: {{ $isSuccess ? '#28a745' : '#333' }}; margin-bottom: 20px; font-weight: 700; }
        p { color: #666; margin-bottom: 30px; line-height: 1.6; }
        .btn-link {
            background: none;
            border: none;
            color: #667eea;
            text-decoration: underline;
            cursor: pointer;
            font-weight: 600;
            padding: 0;
            font-size: 16px;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 30px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            border: none;
            cursor: pointer;
            margin-bottom: 20px;
        }
        .status-message {
            color: #28a745;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .countdown_section {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }
        #countdown {
            font-size: 36px;
            font-weight: 700;
            color: #667eea;
        }
    </style>
</head>
<body>
    @if(!$isSuccess)
    <div class="card">
        <div class="icon">
            <i class="fa fa-envelope-o"></i>
        </div>
        
        <h2>Verify Your Email</h2>
        <p>
            Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="status-message">
                A new verification link has been sent to the email address you provided during registration.
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn-primary">
                Resend Verification Email
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-link">
                Log Out
            </button>
        </form>
    </div>
    @endif

    @if($isSuccess)
    <script>
        // Show SweetAlert success and redirect to homepage
        Swal.fire({
            icon: 'success',
            title: 'Email Verified!',
            text: 'Your email is verified and registration is successfully done!',
            confirmButtonText: 'Go to Homepage',
            confirmButtonColor: '#28a745',
            allowOutsideClick: false
        }).then((result) => {
            window.location.href = '{{ url("/") }}?verified=1';
        });
    </script>
    @else
    <script>
        // Check verification status every 2 seconds
        var checkStatus = setInterval(function() {
            fetch('{{ route("verification.status") }}', {
                credentials: 'same-origin',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.verified) {
                    clearInterval(checkStatus);
                    // Close this old tab (the Gmail link opens homepage in new tab)
                    window.open('', '_self').close();
                    window.close();
                    // Fallback: if closing fails, just hide the content
                    document.body.innerHTML = '<div style="display:flex;align-items:center;justify-content:center;height:100vh;font-family:sans-serif;color:#666;"><p>Email verified! You can close this tab.</p></div>';
                }
            })
            .catch(error => {
                console.error('Status check error:', error);
            });
        }, 2000);
    </script>
    @endif
</body>
</html>
