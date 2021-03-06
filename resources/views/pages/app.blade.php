<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=yes" />
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    {{--meta facebook--}}
    <meta property="og:title" content="Road Web"/>
    <meta property="og:type" content="article"/>
    <meta property="og:description" content="@yield('description')"/>
    <meta property="og:url" content="http://road-web.fr"/>
    <meta property="og:image" content="http://road-web.fr/images/logo.png"/>

    {{--meta twitter--}}
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:site" content="@roadweb"/>
    <meta name="twitter:title" content="RoadWeb"/>
    <meta name="twitter:description"
          content="@yield('description')"/>
    <meta name="twitter:image" content="http://road-web.fr/images/logo.png"/>

    {{--<link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}"/>--}}
    {{--<link href="{{ asset('bower_components/dw-bxslider-4/dist/jquery.bxslider.css') }}" rel="stylesheet"/>--}}
    <link rel="stylesheet" href="{{ asset('css/front/style.css') }}"/>
</head>
<body>

@yield('content')

<script src="{{ asset('javascript/front/bundle.js') }} "></script>
{{--<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>--}}
{{--<script src="{{ asset('javascript/front/app.jobs.js') }}" async></script>--}}

</body>
</html>