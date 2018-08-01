<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>

<!-- Fonts -->
<link rel="dns-prefetch" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="shortcut icon" href="{{{ asset('img/logo.png') }}}">
</head>
<body>

@include('inc.navbar')
<div class="container">
    <main class="py-4">
        @include('inc.messages')
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 card" style="padding: 10px">
                   @include('inc.admin_sidebar')
                </div>
                <div class="col-sm-8 offset-sm-2 col-md-9 offset-md-1 pt-3">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>
</div>
@include('inc.footer')
</body>
</html>