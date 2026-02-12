<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Email Verified - Grace Circle</title>
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
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
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
            background: #d4edda;
            border-radius: 50%;
            margin: 0 auto 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #28a745;
            font-size: 40px;
        }
        h2 { color: #28a745; margin-bottom: 20px; font-weight: 700; }
        p { color: #666; margin-bottom: 20px; line-height: 1.6; }
        .countdown { font-size: 18px; color: #28a745; font-weight: 600; }
    </style>
</head>
<body>
    <div class="card">
        <div class="icon">
            <i class="fa fa-check-circle"></i>
        </div>
        
        <h2>Email Verified Successfully!</h2>
        <p>Your email has been verified. Welcome to Grace Circle Christian Dating!</p>
        <p class="countdown">Redirecting to dashboard<span id="dots">...</span></p>
    </div>

    <script>
        // Animate dots
        let dotCount = 0;
        const dotsInterval = setInterval(() => {
            dotCount = (dotCount + 1) % 4;
            document.getElementById('dots').textContent = '.'.repeat(dotCount);
        }, 500);

        // Broadcast to other tabs that verification is complete
        if (window.localStorage) {
            localStorage.setItem('emailVerified', Date.now().toString());
            localStorage.setItem('verifiedRedirect', 'true');
        }

        // Wait a moment for localStorage to propagate
        setTimeout(function() {
            clearInterval(dotsInterval);
            
            // Try to close this tab immediately (it was just a helper tab)
            // We do NOT redirect window.opener here anymore, because the opener
            // will detect the localStorage event and show a nice modal itself.
            
            // Attempt to close the window
            window.open('', '_self').close();
            window.close();
            
            // If close didn't work (some browsers block this), redirect this tab to dashboard
            setTimeout(function() {
                window.location.href = '{{ route("dashboard") }}?verified=1';
            }, 1000); // Wait a full second before redirecting this tab
        }, 1500);
    </script>
</body>
</html>
