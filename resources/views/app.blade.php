<!DOCTYPE html>
<html lang="pt">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    @routes
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')
    @inertiaHead
    <title>Sistema de Protocolos</title>
  </head>
  <body class="bg-zinc-50 w-full h-screen">
    @inertia
  </body>
</html>