<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hot Wheels — Selmeczy György gyűjteménye</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,400;0,600;0,700;0,900;1,700&family=Barlow:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
</head>
<body>
    <div class="track-lines" aria-hidden="true">
        <span></span><span></span><span></span><span></span><span></span>
    </div>

    <header>
        <a href="{{ route('cars.index') }}" class="logo-wrap">
            <img src="{{ asset('logo.png') }}" alt="Hot Wheels logo" class="logo">
        </a>
        <nav>
            <ul>
                <li><a href="{{ route('cars.index') }}"><span class="nav-icon">🚗</span> Autók</a></li>
                <li><a href="{{ route('colors.index') }}"><span class="nav-icon">🎨</span> Színek</a></li>
                <li><a href="{{ route('designers.index') }}"><span class="nav-icon">✏️</span> Tervezők</a></li>
                <li><a href="{{ route('extras.index') }}"><span class="nav-icon">⚙️</span> Extrák</a></li>
                <li><a href="{{ route('series.index') }}"><span class="nav-icon">📦</span> Szériák</a></li>
                <li><a href="{{ route('years.index') }}"><span class="nav-icon">📅</span> Évek</a></li>
                @if (auth()->check())  
                    <li>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit"><span class="nav-icon">👤</span> Kilépés {{auth()->user()->name}}</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}"><span class="nav-icon">👤</span> Belépés</a></li>
                @endif
            </ul>
        </nav>
        <div class="header-accent" aria-hidden="true">
            <span class="flame">🔥</span>
        </div>
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        <div class="footer-inner">
            <img src="{{ asset('logo.png') }}" alt="" class="footer-logo" aria-hidden="true">
            <p>&copy; 2026 &mdash; Selmeczy György személyes Hot Wheels gyűjteménye</p>
        </div>
    </footer>
</body>
</html>