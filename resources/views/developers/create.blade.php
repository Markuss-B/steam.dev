<x-layout title="Create new developer">
    <form action="{{ route('developers.store') }}" method="POST">
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
            <label for="founded_at">Founded At</label>
            <input id="founded_at" type="date" name="founded_at" value="{{ old('founded_at') }}"
            class="@error('founded_at') is-invalid @enderror">
            @error('founded_at')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="description">Description</label>
            <textarea id="description" name="description" cols="30" rows="10"
            class="@error('description') is-invalid @enderror">{{ old('description') }}</textarea>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        <button type="submit">Create</button>
    </form>
    <a href="{{ route('developers.index') }}">Back to developers</a>
</x-layout>