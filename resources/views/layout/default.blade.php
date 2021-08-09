<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
@include('includes.head')
<body>
    <div class="container">
        <div style="padding-top: 5px;">
            @include('includes.notifications')
        </div>
        @yield('content')
        <!-- Your Page Content Here -->
    </div><!-- /.content-wrapper -->
    
    <div id="loadModal"></div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

<script src="/js/customs.js"></script>

@yield('footer_js')


</body>
</html>
