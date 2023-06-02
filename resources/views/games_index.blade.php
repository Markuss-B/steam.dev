<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Games</title>
</head>
<body>
    <h1>Games</h1>
    <table>
        <thead>
            <tr>
                <th>Game</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Release Date</th>
                <th>Developer</th>
                <th>Publisher</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($games as $game)
                <tr>
                    <td>{{ $game->name }}</td>
                    <td>€{{ $game->price / 100 }}</td>
                    <td>{{ $game->discount }}%</td>
                    <td>{{ $game->release_date }}</td>
                    <td>
                        @foreach ($game->developers as $developer)
                            {{ $developer->name }}@if (!$loop->last), @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($game->publishers as $publisher)
                            {{ $publisher->name }}
                        @endforeach
                    </td>
                </tr>
            @endforeach
</body>
</html>