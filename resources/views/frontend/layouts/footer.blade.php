            <!-- Footer-->
            <footer class="bg-primary py-5">
                <div class="container"><div class="small text-center text-white">{{ setting('copyright_by') }}</div></div>
            </footer>
        </div>

        @if(setting('page_id'))
            <div id="fb-root"></div>
            <!-- Your Chat Plugin code -->
            <div class="fb-customerchat" attribution="setup_tool" page_id="{{ setting('page_id') }}"></div>
        @endif

        <script src="{{ asset('js/app.js') }}"></script>
        <!-- Bootstrap core JS-->
        <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>

        <!-- Font Awesome icons (free version)-->
        <script src="{{ asset('frontend/js/all.js') }}" crossorigin="anonymous"></script>
        <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('frontend/vendor/summernote/summernote-bs4.min.js') }}"></script>
        <script src="{{ asset('backend/vendor/izitoast/dist/js/iziToast.min.js') }}"></script>

        <!-- Core theme JS-->
        <script src="{{ asset('frontend/js/scripts.js') }}"></script>

        <script type="text/javascript">
            jQuery( document ).ready(function() {
                jQuery.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
            });

            @if(session('success'))
                iziToast.success({
                    title: 'Success',
                    message: '{{ session('success') }}',
                    position: 'topRight'
                });
            @endif

            @if(session('error'))
                iziToast.error({
                    title: 'Error',
                    message: '{{ session('error') }}',
                    position: 'topRight'
                });
            @endif

            @if(session('data'))
                iziToast.error({
                    title: 'Error',
                    message: '{{ session('data') }}',
                    position: 'topRight'
                });
            @endif

            @if(setting('page_id'))
                window.fbAsyncInit = function() {
                    FB.init({
                        xfbml            : true,
                        version          : 'v10.0'
                    });
                };

                (function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s); js.id = id;
                    js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));
            @endif

        </script>

        @if(setting('onesignal_app_id'))
            <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
            <script>
                window.OneSignal  = window.OneSignal || [];
                const deviceToken = "{{ auth()->user()->device_token ?? '' }}";

                OneSignal.push(function() {
                    OneSignal.init({
                        appId: "{{ setting('onesignal_app_id') }}",
                        notifyButton: {
                            enable: true,
                        },
                        subdomainName: "{{ setting('onesignal_subdomain_name') }}",
                    });

                    OneSignal.on('subscriptionChange', function (isSubscribed) {
                        OneSignal.push(function() {
                            OneSignal.getUserId(function(userId) {
                                if(deviceToken != userId) {
                                    jQuery.ajax({
                                        type:'POST',
                                        url:'{{ route('frontend.save-device-token') }}',
                                        data:{'device_token': userId},
                                        success:function(data) {
                                            console.log(data);
                                        }
                                    });
                                }
                            });
                        });
                    });
                });
            </script>
        @endif

    </body>
</html>
