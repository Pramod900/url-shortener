<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>

    <div>
        <h2>Login</h2><br>

        @if ($errors)
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>*{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <label>Email:</label>
            <input type="email" name="email"><br><br>
            @error('email')
                <p>*{{ $message }}</p><br>
            @enderror

            <label>Password:</label>
            <input type="password" name="password"><br><br>

            <button type="submit">Login</button>

        </form>
    </div><br><br>

    <div>
        <a href="{{ route('dashboard') }}">View All Short Links</a>
    </div>

</body>

</html>
