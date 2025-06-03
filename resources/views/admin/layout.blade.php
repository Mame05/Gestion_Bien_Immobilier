<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
        }
        .sidebar {
            width: 250px;
            background-color: #343a40;
            min-height: 100vh;
            color: white;
        }
        .sidebar a {
            color: white;
            padding: 15px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            flex: 1;
            background-color: #f8f9fa;
        }
        .topbar {
            background-color: #fff;
            padding: 10px 20px;
            border-bottom: 1px solid #dee2e6;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            padding: 20px;
            text-align: center;
            background-color: #212529;
            border-bottom: 1px solid #444;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <i class="fas fa-building"></i> LOGO
        </div>
        <a href="{{ route('admin.dashboard') }}"><i class="fas fa-chart-line"></i> Tableau de bord</a>
        <a href="{{ route('admin.agences.index') }}"><i class="fas fa-city"></i> Agences</a>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i> Déconnexion
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <!-- Contenu -->
    <div class="content">
        <!-- Topbar -->
        <div class="topbar d-flex justify-content-end align-items-center">
            <span class="me-3">Bienvenue, {{ Auth::user()->nom }}</span>
        </div>

        <div class="p-4">
            @yield('content')
        </div>
    </div>
</body>
</html>
