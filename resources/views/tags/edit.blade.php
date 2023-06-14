<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit {{ $tag->name }}</title>
</head>
<body>
    <h1>Edit {{ $tag->name }}</h1>
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
</body>
</html>