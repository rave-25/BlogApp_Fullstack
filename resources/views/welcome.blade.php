<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
        @vite(['resources/js/app.js', 'resources/css/app.css', 'resources/css/grid.min.css'])

        
        <title>Exam - Trajano</title>
    </head>
    <body>
     <div id="app">
            <!-- The mainapp component should be inside the #app div -->
            <main-page></main-page>
            </div>
     
    </body>
</html>
