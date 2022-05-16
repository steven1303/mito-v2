
<!DOCTYPE html>
<html lang="en">
    <head>
        @include('admins.components.header')
    </head>
    <body class="hold-transition sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">
            <!-- Navbar -->
            @include('admins.components.navbar')
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            @include('admins.components.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div id="content">
                @include('admins.contents.dashboard')
            </div>
        </div>
        <!-- /.content-wrapper -->

        @include('admins.components.footer')
    </body>
</html>
