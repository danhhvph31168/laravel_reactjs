<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title', 'shoppers')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @include('clinet.layouts.partials.css')
</head>

<body>

    <div class="site-wrap">
        <header class="site-navbar" role="banner">
            @include('clinet.layouts.partials.header-top')

            @include('clinet.layouts.partials.header-nav')
        </header>

        @yield('content')

        <footer class="site-footer border-top">
            @include('clinet.layouts.partials.footer')
        </footer>
    </div>

    @include('clinet.layouts.partials.js')
</body>

</html>
