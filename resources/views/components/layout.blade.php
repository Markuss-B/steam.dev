<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'steam.dev admin'}}</title>

    <x-stylesheets />

</head>
<body>

    <x-page-head title='{{$title ?? "steam.dev admin"}}' description="{{$description ?? ''}}" />

    {{ $slot }}

    <footer>
        <hr />
        <a href="{{ route('home') }}">Admin home</a>
</body>
</html>
