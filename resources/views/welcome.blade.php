<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">


    <!-- Add Bootstrap and Bootstrap-Vue CSS to the <head> section -->  

<link type="text/css" rel="stylesheet" href="https://unpkg.com/bootstrap/dist/css/bootstrap.min.css"/>  
<link type="text/css" rel="stylesheet" href="https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.css"/>    

<!-- Add Vue and Bootstrap-Vue JS just before the closing </body> tag -->  
<script src="https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.js"> </script>
    </head>
    <body>
       <div id="app">
        <app></app>
       </div>
    </body>
    <script src="{{ mix('js/app.js') }}"></script>
</html>
