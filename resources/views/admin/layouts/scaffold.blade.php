<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HDAP Admin </title>
    @include('admin.partials.style')
    @stack('styles')
</head>
<body>
    @include('admin.partials.header')
    @include('admin.partials.sidebar')
    @yield('content')
    @include('admin.partials.footer')
    @include('admin.partials.script')
    @stack('scripts')
</body>
</html>