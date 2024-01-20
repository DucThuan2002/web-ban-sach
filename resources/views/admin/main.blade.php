
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Validation Form</title>

  @include('admin.head')
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>

            <li class="nav-item">
                <a href="/shop/logout">Logout</a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    @include('admin.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
        <div class="container-fluid">
            <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- jquery validation -->
                <div class="card card-primary mt-3">
                    <div class="card-header">
                        <h3 class="card-title">{{$title}}</h3>
                    </div>
                    @yield('content')
                </div>
                <!-- /.card -->
                </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">

            </div>
            <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.2.0
        </div>
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>

    </div>

    @include('admin.footer')

    <!-- ./wrapper -->
    <!-- Page specific script -->
    <script>
    $(function () {
    $.validator.setDefaults({
        submitHandler: function () {
        alert( "Form successful submitted!" );
        }
    });
    $('#quickForm').validate({
        rules: {
        email: {
            required: true,
            email: true,
        },
        password: {
            required: true,
            minlength: 5
        },
        terms: {
            required: true
        },
        },
        messages: {
        email: {
            required: "Please enter a email address",
            email: "Please enter a valid email address"
        },
        password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 5 characters long"
        },
        terms: "Please accept our terms"
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
        }
    });
    });
    </script>
</body>
</html>
