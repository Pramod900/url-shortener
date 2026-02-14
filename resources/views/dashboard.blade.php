<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Short Links</title>
</head>

<body>
    <div>
        @if (auth()->user())
            <a href="{{ route(auth()->user()->role . ".dashboard") }}">Go to Dashboard</a>
        @else
            <a href="{{ route('login-page') }}">Login here</a>
        @endif
    </div>
    <div align="center">
        <h2>All Short Links List</h2> 

        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Short Link</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($links as $link)
                    <tr>
                        <td>{{ $loop->iteration }}.</td>
                        <td><a href="{{ $link->short_link }}">{{ $link->short_link }}</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" align="center">No Urls Available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>
</body>

</html>
