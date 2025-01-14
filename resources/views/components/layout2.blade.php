<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/flowbite@1.4.6/dist/flowbite.js"></script>
    <title>Home</title>
</head>
<body class="bg-blue-50">
  <div class="mx-auto px-4 py-6 sm:px-6 lg:px-8">
    {{$slot}}
  </div>
</body>
</html>