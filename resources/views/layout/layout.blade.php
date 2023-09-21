<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Custom Styles -->
    <style>
        body {
            background-color: hsl(0, 0%, 96%);
        }

        /*.login-container {*/
        /*    max-width: 400px;*/
        /*    margin: 0 auto;*/
        /*    margin-top: 100px;*/
        /*    padding: 20px;*/
        /*    background-color: #fff;*/
        /*    border: 1px solid #dee2e6;*/
        /*    border-radius: 4px;*/
        /*    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);*/
        /*}*/
        /*.login-heading {*/
        /*    text-align: center;*/
        /*    margin-bottom: 20px;*/
        /*}*/
    </style>
</head>
<body>
<div class="">
    @yield('content')
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
@include('sweetalert::alert')
@yield('scripts')

</body>
</html>
