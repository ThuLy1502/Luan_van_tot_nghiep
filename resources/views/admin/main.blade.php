<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layout-main.head')
</head>

<body>
    <div class="container-scroller">
        <!-- Navbar.html -->
        @include('admin.layout-main.navbar-1')

        @include('admin.layout-main.navbar-2')
        <!-- Navbar.html ends -->

        <div class="container-fluid page-body-wrapper">
            
            <!-- Sidebar.html -->
            @include('admin.layout-main.sidebar')
            <!-- Sidebar.html ends -->

            <div class="main-panel">
                @yield('content')
                <!-- content-wrapper ends -->

                @include('admin.layout-main.footer')
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- base:js -->
    <script src="{{URL('public/admin/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src="{{URL('public/admin/vendors/chart.js/Chart.min.js')}}"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{URL('public/admin/js/off-canvas.js')}}"></script>
    <script src="{{URL('public/admin/js/hoverable-collapse.js')}}"></script>
    <script src="{{URL('public/admin/js/template.js')}}"></script>
    <script src="{{URL('public/admin/js/settings.js')}}"></script>
    <script src="{{URL('public/admin/js/todolist.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{URL('public/admin/js/dashboard.js')}}"></script>
    <!-- End custom js for this page-->

    <!-- main.js -->
    <script src="{{URL('public/admin/js/main.js')}}"></script>


    <!-- CKEditor -->
    <script src="{{URL('public/ckeditor/ckeditor.js')}}"></script>

    <script>
    CKEDITOR.replace('content');
    CKEDITOR.replace('content-1');
    </script>
</body>

</html>