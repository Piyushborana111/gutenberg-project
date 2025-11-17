<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Gutendex</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
</head>
<body>dasd
  <div id="vue-root">
    <div class="container">

    <h1>Gutenberg Project</h1>
    <p class="subtitle">
      A social cataloging website that allows you to freely search its database of books, annotations, and reviews.
    </p>

    <div class="grid">
      <div class="btn" onclick="goToBooks('Fiction')">📘 Fiction ➜</div>
      <div class="btn" onclick="goToBooks('Drama')">🎭 Drama ➜</div>
      <div class="btn" onclick="goToBooks('Humor')">😂 Humor ➜</div>
      <div class="btn" onclick="goToBooks('Politics')">👤 Politics ➜</div>
      <div class="btn" onclick="goToBooks('Philosophy')">🌀 Philosophy ➜</div>
      <div class="btn" onclick="goToBooks('History')">📚 History ➜</div>
      <div class="btn" onclick="goToBooks('Adventure')">🧭 Adventure ➜</div>
    </div>
  </div>

    <example-component></example-component>
</div>
  <script>
    window.bookShelfsData = @json($bookShelfs);
</script>
</body>
</html>
