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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-white text-gray-800">
  <div class="min-h-screen flex flex-col">
     @include('components.navbarbf')
     
    <main class="flex-1">
      @yield('content')
    </main>

    @include('components.footer')
  </div>
</body>
</html>
