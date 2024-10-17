<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <title>Home</title>
</head>

<body>
  <!-- < class="min-h-full"> -->
    <x-navbar></x-navbar>
    <x-header>{{$title}}</x-header>
    <x-summary>
      <x-slot:totalIncome>{{ $totalIncome }}</x-slot:totalIncome>
      <x-slot:totalOutcome>{{ $totalOutcome }}</x-slot:totalOutcome>
      <x-slot:diff>{{ $diff}}</x-slot:diff>
    </x-summary>
    <main>
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        {{$slot}}
      </div>
    </main>
    <div class="flex justify-center items-center space-x-4">
      <!-- <div class="flex-1"> -->
        <x-pie-chart></x-pie-chart>
      <!-- </div>
      <div class="flex-1"> -->
        <!-- <x-monthly-expense></x-monthly-expense> -->
      <!-- </div> -->
    </div>


</body>

</html>