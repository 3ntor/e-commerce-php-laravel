<!DOCTYPE html>
<html lang="en" >
<head>
    @include('layouts.website.head')
</head>
<body>
    
    @include('layouts.website.navbar')

    @yield('content')

    @include('layouts.website.footer')

    @include('layouts.website.scripts')
    @stack('scripts')

    
</body>
</html>