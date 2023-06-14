<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $game->name }}</title>
</head>
<body>
    <h1>Edit {{ $game->name }}</h1>
    <form action="{{ route('games.update', ['game' => $game->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Name</label>
            <input id="name" type="text" name="name" value="{{ $game->name }}"
            class="@error('name') is-invalid @enderror">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="price">Price</label>
            <input id="price" type="number" name="price" value="{{ $game->price }}"
            class="@error('price') is-invalid @enderror">
            @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="discount">Discount</label>
            <input id="discount" type="number" name="discount" value="{{ $game->discount }}"
            class="@error('discount') is-invalid @enderror">
            @error('discount')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="release_date">Release Date</label>
            <input id="release_date" type="date" name="release_date" value="{{ $game->release_date }}"
            class="@error('release_date') is-invalid @enderror">
            @error('release_date')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="developers">Developers</label>
            <select name="developers[]" multiple>
                @foreach ($developers as $developer)
                    <option value="{{ $developer->id }}"
                        @if ($game->developers->contains($developer->id))
                            selected
                        @endif
                    >
                        {{ $developer->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="publishers">Publishers</label>
            <select name="publishers[]" multiple>
                @foreach ($publishers as $publisher)
                    <option value="{{ $publisher->id }}"
                        @if ($game->publishers->contains($publisher->id))
                            selected
                        @endif
                    >
                        {{ $publisher->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="tags">Tags</label>
            <select name="tags[]" multiple>
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}"
                        @if ($game->tags->contains($tag->id))
                            selected
                        @endif
                    >
                        {{ $tag->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit">Save</button>
    </form>
</body>
</html>