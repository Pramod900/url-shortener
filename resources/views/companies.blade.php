<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Companies</title>
</head>

<body>
    <div>
        <p>Name: {{ $name }}</p>
        <p>Role: {{ $role }}</p>
    </div>
    <a href="{{ route($role . ".dashboard") }}"><<< Back</a>

    <h2>Short Links Company Wise</h2>

    @if (session('url'))
        <div>
            <p>*{{ session('url') }}</p>
        </div>
    @endif
    <table border="1" cellpadding="10" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th width="5%">S.No.</th>
                <th width="50">Company Name</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($companies as $company)
                <tr>
                    <td>{{ $loop->iteration }}.</td>
                    <td>{{ $company->name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" align="center">No Companies Available</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <br>
    <br>
    <br>
    <br>
    <br>

</body>

</html>
