<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
<header>
    <h1>Welcome to the Admin Dashboard</h1>
    <nav>
        <ul>
            <li><a href="{{ route('coordinators.index') }}">Coordinators</a></li>
            <li><a href="{{ route('events.index') }}">Events</a></li>
        </ul>
    </nav>
</header>

<main>
{{--@if(session('success'))--}}
{{--        <div>--}}
{{--            {{ session('success') }}--}}
{{--        </div>--}}
{{--@endif--}}
    @if(session('message'))
        <div>
            {{ session('message') }}
        </div>
    @endif

    @yield('content')
        </main>
</body>
</html>
