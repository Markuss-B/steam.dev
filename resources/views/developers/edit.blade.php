<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $developer->name }}</title>
</head>
<body>
    <h1>Edit developer</h1>
    <a href="{{ route('developers.edit', $developer->id) }}">Edit</a>
    <a href="{{ route('developers.destroy', $developer->id) }}"
        onclick="event.preventDefault();
        document.getElementById('delete-form').submit();">
        Delete
    </a>
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
    <a href="{{ route('developers.index') }}">Back to developers</a>
</body>
</html>