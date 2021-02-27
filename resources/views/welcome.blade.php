<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>DevKind</title>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link href="{{asset(mix('css/app.css'))}}" rel="stylesheet">


</head>

<body class="layout-2">
    <div id="app">
        <router-view></router-view>
    </div>

    <script src="{{asset(mix('js/app.js'))}}"></script>
    



</body>
</html>
