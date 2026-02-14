<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Short Links</title>
</head>

<body>
    <div>
        <p>Name: {{ $name }}</p>
        <p>Role: {{ $role }}</p>
    </div>
    <a href="{{ route($role . '.dashboard') }}">
        <<< Back</a>

            <h2>Short Links List</h2>

            @if (session('invalid_url'))
                <div>
                    <p>*{{ session('invalid_url') }}</p>
                </div>
            @endif
            <table border="1" cellpadding="10" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Short Link</th>
                        <th>Original Link</th>

                        @if (auth()->user()->role === 'superadmin')
                            <th>Company Name</th>
                        @endif

                        @can('view', App\Models\ShortLink::class)
                            <th>Admin/User Name</th>
                            <th>Role</th>
                        @else
                            <th>User Name</th>
                        @endcan
                        <th>Clicks</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($links as $link)
                        <tr>
                            <td>{{ $loop->iteration }}.</td>
                            <td><a href="{{ $link->short_link }}">{{ $link->short_link }}</a></td>
                            <td><a
                                    href="{{ $link->original_url }}">{{ strlen($link->original_url) > 50 ? substr($link->original_url, 0, 50) . '...' : $link->original_url }}</a>
                            </td>

                            @if (auth()->user()->role === 'superadmin')
                                <td>{{ $link->company->name }}</td>
                            @endif

                            <td>{{ $link?->user?->name ?? 'No name' }}</td>

                            @can('view', App\Models\ShortLink::class)
                                <td>{{ $link?->user?->role ?? 'No Role' }}</td>
                            @endcan

                            <td>{{ $link->clicks }}</td>

                        </tr>
                    @empty
                        <tr>
                            @if (auth()->user()->role === 'superadmin')
                                <td colspan="6" align="center">No Urls Available</td>
                            @elseif (auth()->user()->role === 'admin')
                                <td colspan="5" align="center">No Urls Available</td>
                            @else
                                <td colspan="4" align="center">No Urls Available</td>
                            @endif
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
