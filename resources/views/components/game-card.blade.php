<tr class="game-card">
    <!-- You must be the change you wish to see in the world. - Mahatma Gandhi -->
    {{-- <img src="{{ $game->image_url }}" alt="{{ $game->name }} image"> --}}
    <td>
        <a href="{{ route('games.show', ['game' => $game->id]) }}">
            {{ $game->name }}
        </a>
    </td>
    <td>€{{ $game->price / 100 }}</td>
    @if ($game->discount)
        <td>-{{ $game->discount }}%</td>
    @endif
</tr>