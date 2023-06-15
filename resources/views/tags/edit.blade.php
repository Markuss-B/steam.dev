<x-layout title="Edit {{ $tag->name }}">
    <a href="{{ route('tags.index') }}">Back to tags</a>
    <br>
    <a href="{{ route('tags.show', ['tag' => $tag->id]) }}">Back to {{ $tag->name }}</a>
    <form action="{{ route('tags.update', ['tag' => $tag->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="{{ $tag->name }}">
        <button type="submit">Save</button>
    </form>
</x-layout>