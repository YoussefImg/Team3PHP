<!doctype html>
<html>
<head>
    <!-- my head section goes here -->
    <!-- my css and js goes here -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>

    <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
    <script src="/js/app.js"></script>

    <title>@yield('title')</title>

</head>
<body>
    <header> @include('layouts.header') </header>
    <div class="contents"> @yield('content') </div>
    <footer> @include('layouts.footer') </footer>
</body>
</html>
