<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                © {{ date('Y') }} <b>{{ config('app.name') }}</b> - Tüm Hakları Saklıdır.
            </div>
        </div>
    </div>
</footer>
</div>
</div>

<div class="rightbar-overlay"></div>

<!-- JAVASCRIPT -->
<script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>


<script src="{{ asset('assets/libs/morris.js/morris.min.js') }}"></script>
<script src="{{ asset('assets/libs/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('assets/libs/jquery-knob/jquery.knob.min.js') }}"></script>
<script src="{{ asset('assets/libs/metrojs/release/MetroJs.Full/MetroJs.min.js') }}"></script>

<script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script src="{{ asset('assets/js/app.js') }}"></script>


<script>
    @if(session('success'))
    swal("Başarılı!", "{{ session('success') }}", "success");
    @endif

</script>



</body>

</html>