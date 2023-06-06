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
            <input id="name" type="text" name="name" value="{{ old('name') }}"
            class="@error('name') is-invalid @enderror">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="price">Price</label>
            <input id="price" type="number" name="price" value="{{ old('price') }}"
            class="@error('price') is-invalid @enderror">
            @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="discount">Discount</label>
            <input id="discount" type="number" name="discount" value="{{ old('discount') }}"
            class="@error('discount') is-invalid @enderror">
            @error('discount')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="release_date">Release Date</label>
            <input id="release_date" type="date" name="release_date" value="{{ old('release_date') }}"
            class="@error('release_date') is-invalid @enderror">
            @error('release_date')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
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