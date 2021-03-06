<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ asset(mix('/css/app.css')) }}">
    </head>
    <body>
        <div id="app" class="container">
            <div class="row justify-content-center mt-5">
                    <lender-list></lender-list>
            </div>
        </div>

        <!-- Modal -->
        <!-- Modal -->
    </body>
    <script src="{{ asset(mix('/js/app.js')) }}"></script>
</html>
