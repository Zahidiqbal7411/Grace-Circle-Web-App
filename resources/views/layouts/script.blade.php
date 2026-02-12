<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>

<script src="{{ asset('js/map-custome.js') }}"></script>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('js/jquery-2.1.4.min.js') }}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendors/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ asset('vendors/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
<!-- RS5.0 Extensions -->
<script src="{{ asset('vendors/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
<script src="{{ asset('vendors/revolution/js/extensions/revolution.extension.carousel.min.js') }}"></script>
<script src="{{ asset('vendors/revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
<script src="{{ asset('vendors/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
<script src="{{ asset('vendors/revolution/js/extensions/revolution.extension.migration.min.js') }}"></script>
<script src="{{ asset('vendors/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
<script src="{{ asset('vendors/revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
<script src="{{ asset('vendors/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
<script src="{{ asset('vendors/revolution/js/extensions/revolution.extension.video.min.js') }}"></script>

<!-- Extra plugin js -->
<script src="{{ asset('vendors/image-dropdown/jquery.dd.min.js') }}"></script>
<script src="{{ asset('vendors/animate-css/wow.min.js') }}"></script>
<script src="{{ asset('vendors/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('vendors/bootstrap-selector/bootstrap-select.js') }}"></script>
<script src="{{ asset('vendors/bootstrap-datepicker/js/moment-with-locales.js') }}"></script>
<script src="{{ asset('vendors/bootstrap-datepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('vendors/counter-up/waypoints.min.js') }}"></script>
<script src="{{ asset('vendors/counter-up/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('vendors/owl-carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('vendors/bs-tooltip/jquery.webui-popover.min.js') }}"></script>
<script src="{{ asset('vendors/jquery-ui/jquery-ui.js') }}"></script>

<script src="{{ asset('js/video_player.js') }}"></script>
<script src="{{ asset('js/theme.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- firebase-->
<script type="module">
    import {
        initializeApp
    } from "https://www.gstatic.com/firebasejs/11.7.1/firebase-app.js";
    import {
        getMessaging,
        getToken
    } from "https://www.gstatic.com/firebasejs/11.7.1/firebase-messaging.js";

    const firebaseConfig = {
        apiKey: "AIzaSyBrwgArxFsZcugO_ocjqhlksOm7V_25wb8",
        authDomain: "muslimwamuslimachat.firebaseapp.com",
        projectId: "muslimwamuslimachat",
        storageBucket: "muslimwamuslimachat.appspot.com",
        messagingSenderId: "638699867457",
        appId: "1:638699867457:web:62726f86253854e411a5c0"
    };

    const app = initializeApp(firebaseConfig);
    const messaging = getMessaging(app);
    getToken(messaging, {
        vapidKey: "YOUR_VAPID_KEY"
    }).then(token => {
        console.log('Token:', token);
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/axios@1.6.7/dist/axios.min.js"></script>

<script>
    jQuery(document).ready(function($) {
        // CSRF Token setup for axios
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        let token = document.head.querySelector('meta[name="csrf-token"]');
        if (token) {
            axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
        }

        // Handle Registration Form (Delegated)
        $(document).on('submit', '#registrationForm', function(e) {
            e.preventDefault();
            var $form = $(this);
            var $btn = $form.find('#registerBtn');
            var $btnText = $form.find('#registerBtnText');
            var $btnLoader = $form.find('#registerBtnLoader');
            var formData = new FormData(this);

            // Show loader
            if ($btnText.length && $btnLoader.length) {
                $btnText.hide();
                $btnLoader.show();
                $btn.prop('disabled', true);
            }

            // Clear old errors
            $form.find('.text-danger').remove();

            axios.post($form.attr('action'), formData)
                .then(response => {
                    if (response.data.success) {
                        $.magnificPopup.close();
                        Swal.fire({
                            title: 'Registration Successful!',
                            text: response.data.message,
                            icon: 'success',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#e74c3c'
                        }).then(() => {
                            if (response.data.redirect) {
                                window.location.href = response.data.redirect;
                            }
                        });
                    }
                })
                .catch(error => {
                    // Reset button
                    $btnText.show();
                    $btnLoader.hide();
                    $btn.prop('disabled', false);

                    if (error.response && error.response.status === 422) {
                        var errors = error.response.data.errors;
                        var errorSummary = [];
                        var emailTaken = false;
                        
                        Object.keys(errors).forEach(function(key) {
                            var errorMsg = errors[key][0];
                            errorSummary.push(errorMsg);
                            if (errorMsg.toLowerCase().includes('already been taken')) emailTaken = true;
                            
                            var $input = $form.find('[name="' + key + '"]');
                            
                            if (!$input.length && key.includes('.')) {
                                var parts = key.split('.');
                                $input = $form.find('[name="questions[' + parts[1] + ']"]');
                            }

                            if ($input.length) {
                                $input.closest('.form-group').find('.text-danger').remove();
                                $('<small class="text-danger" style="display:block;margin-top:5px;">' + errorMsg + '</small>')
                                    .insertAfter($input.closest('.form-group').find('label').length ? $input.closest('.form-group').find('label') : $input);
                            }
                        });

                        // Show SweetAlert Summary
                        Swal.fire({
                            title: 'Registration Failed',
                            html: errorSummary.join('<br>'),
                            icon: 'error',
                            showCancelButton: emailTaken,
                            cancelButtonText: 'Try Another',
                            confirmButtonText: emailTaken ? 'Login Now instead' : 'Okay',
                            confirmButtonColor: '#e74c3c'
                        }).then((result) => {
                            if (result.isConfirmed && emailTaken) {
                                $.magnificPopup.open({
                                    items: { src: '#small-dialog' },
                                    type: 'inline'
                                });
                            }
                        });
                        
                        // Scroll to first error
                        var $firstError = $form.find('.text-danger').first();
                        if ($firstError.length) {
                            $firstError[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }
                    } else if (error.response && error.response.status === 419) {
                        Swal.fire({
                            title: 'Session Expired',
                            text: 'Your session has expired. Please refresh the page and try again.',
                            icon: 'warning',
                            confirmButtonColor: '#e74c3c'
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Something went wrong. Please try again later.',
                            icon: 'error',
                            confirmButtonColor: '#e74c3c'
                        });
                    }
                });
        });

        // Handle Login Form (Delegated)
        $(document).on('submit', '#loginForm', function(e) {
            e.preventDefault();
            var $form = $(this);
            var $btn = $form.find('#loginBtn');
            var $btnText = $form.find('#loginBtnText');
            var $btnLoader = $form.find('#loginBtnLoader');
            var formData = new FormData(this);

            if ($btnText.length && $btnLoader.length) {
                $btnText.hide();
                $btnLoader.show();
                $btn.prop('disabled', true);
            }

            axios.post($form.attr('action'), formData)
                .then(response => {
                    if (response.data.success) {
                        Swal.fire({
                            title: 'Login Successful!',
                            text: response.data.message,
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.href = response.data.redirect || '/';
                        });
                    }
                })
                .catch(error => {
                    $btnText.show();
                    $btnLoader.hide();
                    $btn.prop('disabled', false);

                    var title = 'Error';
                    var message = 'Something went wrong. Please try again.';
                    var icon = 'error';

                    if (error.response) {
                        if (error.response.status === 403) {
                            title = 'Verification Required';
                            message = error.response.data.message;
                            icon = 'warning';
                        } else if (error.response.status === 422) {
                            title = 'Login Failed';
                            message = Object.values(error.response.data.errors).flat().join('<br>');
                        }
                    }

                    Swal.fire({
                        title: title,
                        html: message,
                        icon: icon,
                        confirmButtonColor: '#e74c3c'
                    });
                });
        });

        // Subscription Warnings & Popups
        @if(session('subscription_warning'))
            Swal.fire({
                title: 'Subscription Expired',
                text: 'Your subscription expired {{ session('subscription_days_expired') }} days ago. You are currently in a 3-day grace period.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Renew Now',
                cancelButtonText: 'Later',
                confirmButtonColor: '#27ae60'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('subscription.required') }}";
                }
            });
        @endif

        @if(session('subscription_expiring_soon'))
            Swal.fire({
                title: 'Trial Ending Soon',
                text: 'Your access will expire within {{ session('subscription_days_left') <= 0 ? 'a few hours' : '1 day' }}. Subscribe now to keep your premium access!',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Upgrade Now',
                cancelButtonText: 'Remind Me Later',
                confirmButtonColor: '#27ae60'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('subscription.required') }}";
                }
            });
        @endif

        @if(session('success'))
            Swal.fire({
                title: 'Success!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonColor: '#27ae60'
            });
        @endif

        @if(session('error'))
            Swal.fire({
                title: 'Error!',
                text: "{{ session('error') }}",
                icon: 'error',
                confirmButtonColor: '#e74c3c'
            });
        @endif
    });
</script>

@if (auth()->check())
<script>
    // Professional Verification Sync
    (function() {
        // Use the same channel as verify-email.blade.php
        const channel = window.BroadcastChannel ? new BroadcastChannel('email_verification') : null;
        
        function handleGlobalVerified() {
            // Priority 1: If the page has THE_SIMPLE_TRICK, run the closure logic
            if (typeof THE_SIMPLE_TRICK === 'function') {
                THE_SIMPLE_TRICK();
                return;
            }

            // Priority 2: If on verify-email but function missing (rare), redirect
            if (window.location.pathname.includes('verify-email')) {
                window.location.href = '{{ route("home") }}?verified=1';
            } else {
                // Priority 3: Normal pages (like Home) refresh to update UI
                window.location.reload();
            }
        }

        if (channel) {
            channel.onmessage = (event) => {
                if (event.data === 'verified') handleGlobalVerified();
            };
        }

        window.addEventListener('storage', (e) => {
            if (e.key === 'grace_verify_signal') handleGlobalVerified();
        });

        // Professional Polling Method (Every 4 seconds)
        @if(!auth()->user()->hasVerifiedEmail())
        setInterval(async () => {
            try {
                const res = await fetch('{{ route("verification.status") }}');
                const data = await res.json();
                if (data.verified) handleGlobalVerified();
            } catch(e) {}
        }, 4000);
        @endif
    })();
</script>
@endif

@if (auth()->check() && auth()->user()->profile_status == 0 && auth()->user()->hasVerifiedEmail())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = $('#completeProfileModal');
        const questionsList = document.getElementById('questionsList');
        const completeForm = document.getElementById('completeProfileForm');
        const progressBar = document.getElementById('profileProgressBar');
        const progressText = document.getElementById('progressText');

        if (!modal.length || !questionsList || !completeForm) return;

        const categoryIcons = {
            'Personal': 'user',
            'Spiritual': 'pray',
            'Lifestyle': 'glass-cheers',
            'Values': 'balance-scale',
            'Default': 'question-circle',
            'Authority over darkness': 'shield-alt',
            'Spiritual sensitivity': 'wind',
            'Divine direction': 'compass',
            'Knowing God': 'bible'
        };

        function updateProgress() {
            const total = $('#questionsList input[type="hidden"]').length;
            const answered = $('#questionsList input[type="hidden"]').filter(function() {
                return $(this).val() !== '';
            }).length;
            
            const percent = total > 0 ? Math.round((answered / total) * 100) : 0;
            progressBar.style.width = percent + '%';
            progressText.innerText = percent + '% Completed';
            
            if (percent === 100) {
                progressText.innerHTML = '✨ All Set! Ready to complete.';
                progressText.style.color = '#48bb78';
            } else {
                progressText.style.color = '#764ba2';
            }
        }

        // Load questions when modal is opened
        modal.on('show.bs.modal', function() {
            if (questionsList.innerHTML.includes('fa-circle-notch') || questionsList.innerHTML === '') {
                fetch('{{ route("profile.questions") }}')
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            let html = '';
                            for (const [category, questions] of Object.entries(data.questions)) {
                                const icon = categoryIcons[category] || categoryIcons['Default'];
                                html += `
                                    <div class="question-group">
                                        <div class="category-header">
                                            <div class="category-icon"><i class="fa fa-${icon}"></i></div>
                                            <h4 class="category-title">${category}</h4>
                                        </div>
                                        <div class="questions-grid">
                                `;
                                questions.forEach(q => {
                                    html += `
                                        <div class="question-card">
                                            <label class="question-label">${q.question_text}</label>
                                            <div class="question-options" data-question-id="${q.id}">
                                                <input type="hidden" name="questions[${q.id}]" value="">
                                                <button type="button" class="option-btn" data-value="Yes">Yes</button>
                                                <button type="button" class="option-btn" data-value="No">No</button>
                                            </div>
                                        </div>
                                    `;
                                });
                                html += `</div></div>`;
                            }
                            questionsList.innerHTML = html;

                            // Handle option selection
                            $('.option-btn').on('click', function() {
                                const parent = $(this).closest('.question-options');
                                parent.find('.option-btn').removeClass('active');
                                $(this).addClass('active');
                                parent.find('input').val($(this).data('value'));
                                updateProgress();
                                
                                // Visual feedback on card
                                $(this).closest('.question-card').css('border-color', '#48bb78');
                                $(this).closest('.question-card').css('background-color', 'rgba(72, 187, 120, 0.02)');
                            });
                            
                            updateProgress();
                        }
                    })
                    .catch(err => {
                        questionsList.innerHTML = '<div class="alert alert-danger text-center p-5"><h4>Connection error.</h4><p>Please check your internet and try again.</p></div>';
                    });
            }
        });

        // Handle Form Submission
        completeForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validate all questions answered
            let allAnswered = true;
            let firstUnanswered = null;

            $('#questionsList input[type="hidden"]').each(function() {
                if ($(this).val() === '') {
                    allAnswered = false;
                    $(this).closest('.question-card').css('border-color', '#f56565');
                    $(this).closest('.question-card').css('background-color', 'rgba(245, 101, 101, 0.05)');
                    if (!firstUnanswered) firstUnanswered = $(this).closest('.question-card');
                }
            });

            if (!allAnswered) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Incomplete Answers',
                    text: 'Please answer all questions to build your spiritual profile!',
                    confirmButtonColor: '#764ba2'
                });
                
                if (firstUnanswered) {
                    $('.questions-container').animate({
                        scrollTop: firstUnanswered.position().top + $('.questions-container').scrollTop() - 50
                    }, 800);
                }
                return;
            }

            const btn = document.getElementById('saveProfileBtn');
            const text = document.getElementById('saveBtnText');
            const loader = document.getElementById('saveBtnLoader');

            btn.disabled = true;
            text.classList.add('d-none');
            loader.classList.remove('d-none');

            const formData = new FormData(completeForm);
            
            axios.post('{{ route("profile.complete") }}', formData)
                .then(res => {
                    if (res.data.success) {
                        modal.modal('hide');
                        $('.profile-alert-bar').fadeOut(800);
                        
                        Swal.fire({
                            icon: 'success',
                            title: 'Congratulations!',
                            text: res.data.message,
                            confirmButtonColor: '#764ba2',
                            background: '#fff url(/img/confetti.gif)',
                            timer: 5000,
                            timerProgressBar: true
                        });
                    }
                })
                .catch(err => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'We couldn\'t save your profile. Please try once more.',
                    });
                })
                .finally(() => {
                    btn.disabled = false;
                    text.classList.remove('d-none');
                    loader.classList.add('d-none');
                });
        });
    });
</script>
@endif

@if (session('login_success') || session('reg_success') || session('success') || request()->query('verified'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let title = '';
        let text = '';
        
        @if (session('login_success'))
            title = 'Login Successful';
            text = "{{ session('login_success') }}";
        @elseif (session('success'))
            title = 'Payment Successful';
            text = "{{ session('success') }}";
        @elseif (session('reg_success'))
            title = 'Registration Successful';
            text = "{{ session('reg_success') }}";
        @elseif (request()->query('verified'))
            title = 'Registration Successful!';
            text = "Your email has been verified successfully!";
        @endif

        Swal.fire({
            icon: 'success',
            title: title,
            text: text,
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            width: '600px',
            padding: '3em',
            color: '#2f3c44',
            background: '#fff',
            backdrop: `
                rgba(0,0,123,0.4)
            `
        });
        
        // Remove the ?verified=1 from URL so it doesn't show again on refresh
        if (window.location.search.includes('verified')) {
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    });
</script>
@endif
