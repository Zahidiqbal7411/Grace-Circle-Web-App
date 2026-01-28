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
