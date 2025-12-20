<!DOCTYPE html>
<html>
<head>
    <title>Online Courses</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        a { margin-right: 10px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 8px; }
        .error { color: red; }
    </style>
</head>
<body>

<h1>Online Courses</h1>

<nav>
    <a href="{{ route('courses.index') }}">Courses</a>
    <a href="{{ route('courses.create') }}">Create Course</a>
</nav>

<hr>

@yield('content')

</body>
</html>

