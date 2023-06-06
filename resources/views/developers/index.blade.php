<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Developers</title>
</head>
<body>
    <h1>Developers</h1>
    <a href="{{ route('developers.create') }}">Create new developer</a>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($developers as $developer)
                <tr>
                    <td>
                        <a href="{{ route('developers.show', $developer->id) }}">
                            {{ $developer->name }}
                        </a>
                    <td>
                        <a href="{{ route('developers.edit', $developer->id) }}">Edit</a>
                        <form action="{{ route('developers.destroy', $developer->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
</body>
</html>