<x-layout title="Create new tag">
    <a href="{{ route('tags.index') }}">Back to tags</a>
    <form action="{{ route('tags.store') }}" method="POST">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" id="name">
        <button type="submit">Save</button>
    </form>
</x-layout>