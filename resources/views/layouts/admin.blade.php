<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Teaching Factory')</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Font Awesome & Google Fonts -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8fafc;
    }
  </style>
</head>
<body class="flex">

  <!-- SIDEBAR -->
  <aside id="sidebar"
    class="fixed top-0 left-0 h-screen w-64 bg-white shadow-lg flex flex-col transition-transform duration-300 lg:translate-x-0 -translate-x-full z-50">

    <!-- Logo Section -->
    <div class="p-5 border-b border-gray-100">
      <a href="#" class="flex items-center space-x-3 text-slate-800">
        <div class="w-10 h-10 flex items-center justify-center bg-gradient-to-br from-indigo-500 to-indigo-700 text-white rounded-lg text-lg">
          <i class="fa-solid fa-chart-line"></i>
        </div>
        <div>
          <h1 class="font-bold text-base leading-tight">Teaching Factory</h1>
          <p class="text-xs text-gray-500">SISTEM MANAJEMEN</p>
        </div>
      </a>
    </div>

    <!-- Menu Items -->
    <nav class="flex-1 overflow-y-auto p-4">
      <a href="{{ route('dashboard.admin_sekolah') }}"
         class="flex items-center space-x-3 px-4 py-2 rounded-lg mb-2 text-gray-600 hover:bg-gray-100 hover:text-indigo-600
         {{ request()->routeIs('dashboard.admin_sekolah') ? 'bg-indigo-600 text-white shadow-md' : '' }}">
         <i class="fa-solid fa-gauge-high"></i><span>Dashboard</span>
      </a>

      <a href="{{ route('user.admin_sekolah') }}"
         class="flex items-center space-x-3 px-4 py-2 rounded-lg mb-2 text-gray-600 hover:bg-gray-100 hover:text-indigo-600
         {{ request()->routeIs('user.admin_sekolah') ? 'bg-indigo-600 text-white shadow-md' : '' }}">
         <i class="fa-solid fa-users"></i><span>Users</span>
      </a>

      <a href="{{ route('jurusan.admin_sekolah') }}"
         class="flex items-center space-x-3 px-4 py-2 rounded-lg mb-2 text-gray-600 hover:bg-gray-100 hover:text-indigo-600
         {{ request()->routeIs('jurusan.admin_sekolah') ? 'bg-indigo-600 text-white shadow-md' : '' }}">
         <i class="fa-solid fa-briefcase"></i><span>Jurusan & Kelas</span>
      </a>

      <a href="{{ route('laporan.admin_sekolah') }}"
         class="flex items-center space-x-3 px-4 py-2 rounded-lg text-gray-600 hover:bg-gray-100 hover:text-indigo-600
         {{ request()->routeIs('laporan.admin_sekolah') ? 'bg-indigo-600 text-white shadow-md' : '' }}">
         <i class="fa-solid fa-folder"></i><span>Laporan</span>
      </a>
    </nav>
  </aside>

  <!-- MAIN CONTENT -->
  <div class="flex-1 min-h-screen lg:ml-64 transition-all">

    <!-- Top Navbar -->
    <nav class="bg-white rounded-xl shadow-md p-4 flex justify-between items-center mx-4 my-4">
      <button id="sidebar-toggle" class="lg:hidden text-gray-700 text-xl">
        <i class="fa-solid fa-bars"></i>
      </button>

      <div class="hidden lg:block w-1/3">
        <input type="text" placeholder="Search here..."
               class="w-full px-4 py-2 rounded-lg bg-gray-100 text-gray-700 focus:ring-2 focus:ring-indigo-400 outline-none">
      </div>

      <div class="flex items-center space-x-4">
        <i class="fa-solid fa-bell text-gray-500 text-lg"></i>
        <div class="flex items-center space-x-3">
          <img src="https://i.ibb.co/L8y2wVp/avatar.png" alt="Avatar" class="w-10 h-10 rounded-full">
          <div>
            <h2 class="font-semibold text-gray-800 text-sm">{{ Auth::user()->username ?? 'Sukadi' }}</h2>
            <p class="text-xs text-gray-500">Admin TEFA</p>
          </div>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <main class="px-4 pb-6">
      @yield('content')
    </main>
  </div>

  <!-- SCRIPT -->
  <script>
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebar = document.getElementById('sidebar');

    sidebarToggle?.addEventListener('click', () => {
      sidebar.classList.toggle('-translate-x-full');
    });
  </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  @stack('scripts')
</body>
</html>
