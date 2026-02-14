<!DOCTYPE html>
<html>

<head>
    <title>Super Admin Dashboard</title>
</head>

<body>

    <h1>Super Admin Dashboard</h1>
    <small>Name: {{ $user->name }}</small><br>
    <small>Role: {{ $user->role }}</small>

    <hr>

    <h2>Actions</h2>

    <a href="{{ route('short-link.all') }}">View All Short Links</a>&nbsp;&nbsp;
    
    <hr>

    <div>
        <h2>Invite a user as admin</h2>
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>*{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <p>** {{ session('success') }} **</p>
        @endif
        <form action="{{ route('invitation.store') }}" method="POST">
            @csrf

            <label for="">Email:</label>
            <input type="text" name="email"><br><br>

            <label for="">Company Name:</label>
            <input type="text" name="company"><br><br>

            <label for="">Role:</label>
            <select name="role" id="">
                <option value="admin">Admin</option>
            </select><br><br>

            <button>Invite User</button>
        </form>
    </div>

    <hr>
    <br><br>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>

</body>

</html>
