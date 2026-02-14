<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
</head>

<body>

    <h1>Admin Dashboard</h1>
    <div>
        <p>Name: {{ $user->name }}</p>
        <p>Role: {{ $user->role }}</p>
    </div>

    <hr>

    <h2>Admin Actions</h2>

    <a href="{{ route('short-link') }}">Create Short Link</a>&nbsp;&nbsp;|&nbsp;
    <a href="{{ route('short-link.all') }}">View All Short Links</a>&nbsp;&nbsp;

    <hr>

    <div>
        <h2>Invite a user</h2>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>*{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        @if (session('success'))
            <p>** {{ session('success') }} **</p>
        @endif
        
        <form action="{{ route('invitation.store') }}" method="POST">
            @csrf

            <label for="">Email:</label>
            <input type="text" name="email"><br><br>

            <label for="">Role:</label>
            <select name="role" id="">
                <option value="admin">Admin</option>
                <option value="member" selected>Member</option>
            </select><br><br>

            <button>Invite User</button>
        </form>
    </div>

    <hr>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>

</body>

</html>
