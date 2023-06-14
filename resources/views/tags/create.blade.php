<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create new tag</title>
</head>
<body>
    <h1>Create new tag</h1>
    <a href="{{ route('tags.index') }}">Back to tags</a>
    <form action="{{ route('tags.store') }}" method="POST">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" id="name">
        <button type="submit">Save</button>
    </form>
</body>
</html>