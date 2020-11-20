<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<head>
    <meta charset="utf-8"/>
    <title>Panel</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous"></head>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <link href="{{ asset("assets/stylesheets/datatables.min.css") }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <link href="{{ asset("assets/stylesheets/basic.css") }}" rel="stylesheet">

    <!-- Inspirina -->
    <link href="{{ asset("assets/stylesheets/bootstrap.min.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/stylesheets/style.css") }}" rel="stylesheet">

</head>
    <body>
        @yield('body')
        


        <script src="{{ asset("assets/scripts/jquery-2.1.1.js") }}"></script>
        <script src="{{ asset("assets/scripts/jquery.metisMenu.js") }}"></script>
        <script src="{{ asset("assets/scripts/jquery.slimscroll.min.js") }}"></script>
        <script src="{{ asset("assets/scripts/inspinia.js") }}"></script>
        <script src="{{ asset("assets/scripts/pace.min.js") }}"></script>

        <script src="{{ asset("assets/scripts/datatables.min.js") }}"></script>

        <!-- Peity -->
        <script src="{{ asset("assets/scripts/jquery.peity.min.js") }}"></script>
        <script src="{{ asset("assets/scripts/jquery-ui.min.js") }}"></script>
        <script src="{{ asset("assets/scripts/bootstrap.min.js") }}"></script>

        <!-- iCheck -->
        <script src="{{ asset("assets/scripts/icheck.min.js") }}"></script>

        <!-- Peity d data  -->
        <script src="{{ asset("assets/scripts/peity-demo.js") }}"></script>

        <!-- Peity d data  -->
        <script src="{{ asset("assets/scripts/validation_fields.js") }}"></script>
    </body>
</html>