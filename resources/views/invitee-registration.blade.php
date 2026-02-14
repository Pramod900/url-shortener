<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
</head>
<body>

    <h2>Fill the form to register</h2>

    @if($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
            <li>*{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('invitee.register') }}" method="POST">
        @csrf
        
        <input type="hidden" value="{{ $token }}" name="token">
        <input type="hidden" value="{{ $companyName }}" name="companyName">
        <div>
            <label>Full Name:</label><br>
            <input type="text" name="full_name">
        </div>
        <br>


        <div>
            <label>Email:</label><br>
            <input type="email" name="email">
        </div>
        <br>

        <div>
            <label>Password:</label><br>
            <input type="password" name="password">
        </div>
        <br>

        <div>
            <label>Confirm Password:</label><br>
            <input type="password" name="password_confirmation">
        </div>
        <br>

        <br>

        <div>
            <input type="submit" value="Register">
        </div>

    </form>

</body>
</html>
