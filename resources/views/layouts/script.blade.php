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
    });
</script>
