<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SKINKARE</title>

  <!-- Hubungkan Tailwind dan Flowbite -->
  <script src="{{ asset('styles/tailwindcss3.4.1.js') }}"></script>
  <script src="{{ asset('styles/flowbite.min.js') }}"></script>
<script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Awesome untuk ikon -->
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body class="bg-white text-gray-800">
  <div class="min-h-screen flex flex-col">
    @include('components.navbar')

    <main class="flex-1">
      @yield('content')
    </main>
      </div>
</body>
</html>