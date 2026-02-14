<!DOCTYPE html>
<html>
<head>
    <title>Member Dashboard</title>
</head>
<body>

    <h1>Member Dashboard</h1>
    <div>
        <p>Name: {{ $user->name }}</p>
        <p>Role: {{ $user->role }}</p>
    </div>

    <hr>

    <h2>Member Actions</h2>

    <a href="{{ route('short-link') }}">Create Short Link</a>&nbsp;&nbsp;|&nbsp;&nbsp;
    <a href="{{ route('short-link.all') }}">My Short Links</a>&nbsp;&nbsp;

    <hr>

    <hr>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>

</body>
</html>
