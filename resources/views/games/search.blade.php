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
            <x-game-row :game="$game" />
        @endforeach
    </tbody>
</table>
{{ $games->appends(request()->query())->links() }}

</x-app-layout>