<!DOCTYPE html>
<html lang="en">

<head>
    @include('head')
    @yield('css')
</head>

<body>

    <!-- Topbar Start -->
    @include('topbar')

    <!-- Topbar End -->

    <!-- Navbar Start -->
    @include('navbar')

    <!-- Navbar End -->


    @yield('content')


    <!-- Footer Start -->
    @include('footer')

    <!-- Footer End -->

    @include('back-to-top')

    <!-- Back to Top -->


    @include('js-files')
    @yield('scripts')

</body>

</html>