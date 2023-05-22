<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('./favicon.ico') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edica</title>
    <script src="{{ asset('assets/vendors/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/loader.js') }}"></script>
    @vite('resources/css/app.css')
</head>
<body>
@yield('content')
</body>
<script src="https://kit.fontawesome.com/b8991598b2.js"></script>
<script src="{{ asset('assets/vendors/popper.js/popper.min.js') }}"></script>
<script src="{{ asset('assets/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/vendors/aos/aos.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script>
    AOS.init({
        duration: 1000
    });
</script>
@vite('resources/js/app_front.js')
</html>
