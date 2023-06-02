<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create new game</title>
</head>
<body>
    <h1>Create new game</h1>
    <form action="{{ route('games.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Name</label>
            <input type="text" name="name">
        </div>
        <div>
            <label for="price">Price</label>
            <input type="number" name="price">
        </div>
        <div>
            <label for="discount">Discount</label>
            <input type="number" name="discount">
        </div>
        <div>
            <label for="release_date">Release Date</label>
            <input type="date" name="release_date">
        </div>
        <div>
            <label for="developers">Developers</label>
            <select name="developers[]" multiple>
                @foreach ($developers as $developer)
                    <option value="{{ $developer->id }}">
                        {{ $developer->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="publishers">Publishers</label>
            <select name="publishers[]" multiple>
                @foreach ($publishers as $publisher)
                    <option value="{{ $publisher->id }}">
                        {{ $publisher->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit">Save</button>
    </form>
</body>
</html>