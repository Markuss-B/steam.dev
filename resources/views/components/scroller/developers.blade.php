@foreach($developers as $developer)
    <x-dev-card :dev="$developer"/>
@endforeach
