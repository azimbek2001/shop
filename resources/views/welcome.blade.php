<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ env('APP_NAME') }}</title>
        <link href="" rel="stylesheet">
    </head>
    <body>
       
          <noscript>You need to enable JavaScript to run this app.</noscript>
    <div id="root"></div>
   
  
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>

