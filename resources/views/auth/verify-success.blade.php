<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Email Verified - Grace Circle</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Outfit', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .success_card {
            background: white;
            border-radius: 20px;
            padding: 50px;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            max-width: 500px;
            width: 90%;
        }
        .success_icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #28a745, #20c997);
            border-radius: 50%;
            margin: 0 auto 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .success_icon i {
            font-size: 50px;
            color: white;
        }
        h2 {
            color: #28a745;
            margin-bottom: 20px;
            font-weight: 700;
        }
        .message {
            color: #666;
            font-size: 18px;
            margin-bottom: 30px;
        }
        .countdown_section {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
        }
        .countdown_section p {
            color: #666;
            margin-bottom: 10px;
        }
        #countdown {
            font-size: 48px;
            font-weight: 700;
            color: #667eea;
        }
        .countdown_section .small {
            color: #888;
            font-size: 14px;
        }
        .btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 40px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            transition: transform 0.3s, box-shadow 0.3s;
            border: none;
            cursor: pointer;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        }
    </style>
</head>
<body>
    <div class="success_card">
        <!-- Success Icon -->
        <div class="success_icon">
            <i class="fa fa-check"></i>
        </div>
        
        <h2>Email Verified Successfully!</h2>
        
        <p class="message">
            Your email has been verified. You can now access to your account.
        </p>
        
        <div class="countdown_section">
            <p>Redirecting to homepage in</p>
            <div id="countdown">20</div>
            <p class="small">seconds</p>
        </div>
        
        <a href="{{ url('/') }}" class="btn">
            Go to Homepage Now
        </a>
    </div>

    <script>
        // Countdown timer
        var seconds = 20;
        var countdownElement = document.getElementById('countdown');
        
        var countdown = setInterval(function() {
            seconds--;
            countdownElement.textContent = seconds;
            
            if (seconds <= 0) {
                clearInterval(countdown);
                window.location.href = '{{ url("/") }}';
            }
        }, 1000);
    </script>
</body>
</html>
