<x-app-layout title="Search games" :basiclayout='true'>
<form action="{{ route('games.search') }}" method="GET" class="w-max">
    <input type="text" name="search" placeholder="Search by name" value="{{ old('search') }}">
    <input type="checkbox" name="on_sale" id="on_sale" {{ old('on_sale') ? 'checked' : '' }}>
    <label for="on_sale">On sale</label>

    <select name="sort">
        <option value="name" {{ old('sort') === 'name' ? 'selected' : '' }}>Sort by Name</option>
        <option value="price" {{ old('sort') === 'price' ? 'selected' : '' }}>Sort by Price</option>
        <option value="release_date" {{ old('sort') === 'release_date' ? 'selected' : '' }}>Sort by Release Date</option>
    </select>
    <input type="checkbox" name="order" id="order" {{ old('order') ? 'checked' : '' }}>
    <label for="order">Descending</label>
    

    
    <div class="tags-container h-64 overflow-x-hidden float-right">
        @foreach($tags as $tag)
        <div class="tag-checkbox">
            <input type="checkbox" name="tags[]" id="tag{{ $tag->id }}" value="{{ $tag->name }}" {{ in_array($tag->name, old('tags', [])) ? 'checked' : '' }}>
            <label for="tag{{ $tag->id }}">{{ $tag->name }}</label>
        </div>
    @endforeach
    
    </div>

    <button type="submit">Search</button>
</form>

<table>
    <thead>
        <tr>
            <th>Game</th>
            <th>Price</th>
            <th>Discount</th>
            <th>Release Date</th>
            <th>Developer</th>
            <th>Publisher</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($games as $game)
            <tr>
                <td>
                    <a href="{{ route('games.show', ['game' => $game->id]) }}">
                        {{ $game->name }}
                    </a>
                </td>
                <td>€{{ $game->price / 100 }}</td>
                <td>{{ $game->discount }}%</td>
                <td>{{ $game->release_date }}</td>
                <td>
                    @foreach ($game->developers as $developer)
                        <a href="{{ route('developers.show', ['developer' => $developer->id]) }}">
                            {{ $developer->name }}</a>@if (!$loop->last), @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($game->publishers as $publisher)
                        {{ $publisher->name }}
                    @endforeach
                </td>
                <td>
                    {{-- edit game --}}
                    <a href="{{ route('games.edit', ['game' => $game->id]) }}">Edit</a>
                    {{-- delete game --}}
                    <form action="{{ route('games.destroy', ['game' => $game->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
            </tr>
        @endforeach
    </tbody>
</table>

</x-app-layout>