<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raihan Farid</title>
 
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> 
</head>
<body>
    <header>
        <nav>
            <ul>
                <li>
                    <a href="{{ route('items.index') }}" class="nav-link">
                        Home
                    </a>
                </li>
            </ul>
        </nav>
    </header>
    <div class="container">
        @yield('content')
    </div>

    @yield('scripts')
</body>
</html>
