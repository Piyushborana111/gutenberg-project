asdasd<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Laravel + Vue</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
  <div id="app">
    <!-- agar globally register kiya to -->
    <example-component></example-component>

    <!-- ya manual mount target -->
    <div id="vue-root"></div>
  </div>
</body>
</html>
