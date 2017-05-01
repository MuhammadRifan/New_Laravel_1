<!DOCTYPE html>
<html>
    <head>
        <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="/assets/css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="/assets/css/jumbotron-narrow.css" rel="stylesheet">
        <title>Blog Laravel</title>
    </head>

    <body>
        <div class="container">
            <div class="header clearfix">
                <nav>
                    <ul class="nav nav-pills pull-right">
                      <li role="presentation"><a href="/">Home</a></li>
                      @if (session()->has('nama'))
                          <li role="presentation"><a href="/profil">{{ session('nama') }}</a></li>
                          <li role="presentation"><a href="/logout">Logout</a></li>
                      @else
                          <li role="presentation"><a href="/login">Login</a></li>
                          <li role="presentation"><a href="/register">Register</a></li>
                      @endif
                    </ul>
                </nav>
                <h3 class="text-muted">@yield('title')</h3>
            </div>

            @yield('content')<br>

            <footer class="footer">
                <p>&copy; 2017 Company, Inc.</p>
            </footer>
        </div>
    </body>

    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
</html>
