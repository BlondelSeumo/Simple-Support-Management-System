                    </div>
                    <!-- End of Main Content -->
                    <!-- Footer -->
                    <footer class="sticky-footer bg-white">
                        <div class="container my-auto">
                            <div class="copyright text-center my-auto">
                                <span>{{ setting('copyright_by') }}</span>
                            </div>
                        </div>
                    </footer>
                    <!-- End of Footer -->
                </div>
                <!-- End of Content Wrapper -->
            </div>
            <!-- End of Page Wrapper -->
        </div>

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('global.ready_to_leave') }}</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">{{ __('global.ready_to_leave_message') }}</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">{{ __('global.cancel') }}</button>
                        <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('global.logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{ asset('backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ asset('backend/js/sb-admin-2.min.js') }}"></script>
        <script src="{{ asset('backend/vendor/izitoast/dist/js/iziToast.min.js') }}"></script>

        @stack('footer_scripts')
        
        <script src="{{ asset('backend/js/custom.js') }}"></script>

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
        </script>

    </body>
</html>
