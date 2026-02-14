<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Short Urls</title>
</head>

<body>
    <h1>Create Short Link</h1>
    <hr>
    <br>
    <br>
    @if ($errors)
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>*{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div>
        <form action="{{ route('short-link.create') }}" method="POST">
            @csrf
            Url: <input type="text" placeholder="Paste url..." name="url"><br><br>
            <button>Create Short Url</button>
        </form>
    </div>
</body>

</html>
