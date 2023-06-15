<x-layout title="Edit developer {{ $developer->name }}">
    <a href="{{ route('developers.index') }}">Back to developers</a>
    <br>
    <a href="{{ route('developers.show', $developer->id) }}">Back to {{ $developer->name }}</a>
    <form action="{{ route('developers.update', $developer->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Name</label>
            <input id="name" type="text" name="name" value="{{ $developer->name }}"
            class="@error('name') is-invalid @enderror">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="founded_at">Founded At</label>
            <input id="founded_at" type="date" name="founded_at" value="{{ $developer->founded_at }}"
            class="@error('founded_at') is-invalid @enderror">
            @error('founded_at')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="description">Description</label>
            <textarea id="description" name="description" cols="30" rows="10"
            class="@error('description') is-invalid @enderror">{{ $developer->description }}</textarea>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        <button type="submit">Update</button>
    </form>
</x-layout>
