<x-app-layout title="Library">
    <x-slot name="styles">
        @vite('resources/css/library.css')
        @vite('resources/js/library.js')
    </x-slot>
    <div class="sidemenu">
        <div class="header">
            <div id="buttons">
                <div class="closeBtn btn" id="closeBtn">&#9776;</div>
                <div class="homeBtn btn" id="homeBtn">Home</div>
            </div>
            <!--
            <div>
                <label for="type-select"></label>
                <select id="type-select">
                    <option value="game">Games</option>
                    <option value="software">Software</option>
                    <option value="tools">Tools</option>
                </select>
            </div>
            -->
            <input id="searchInput" type="text" placeholder="Search for games..">
            <div id="hourssearch">
                <label>Search by hours</label>
                <input id="minhours" type="text" placeholder="min">
                <input id="maxhours" type="text" placeholder="max">
                <div id="hours_warning" class="warning"></div>
            </div>
        </div>
        <div class="game-container">
            <ul id="gamelist">
                @foreach ($games as $game)
                    <li class="game-l" data-id="{{ $game->id }}">
                        <span class="icon">
                            <img src="https://placehold.it/20x20" alt="{{ $game->name }} icon">
                        </span>
                        <span class="name">{{ $game->name }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="main" id="main">
        <div class="hamburger" id="hamBtn">
            <button>&#9776;</button>
        </div>
        <div id="game" class="screen"></div>
    </div>
</x-app-layout>

<script>
    $(document).ready(function () {
        $('.game-l').click(function () {
            var gameId = $(this).data('id');
            $.ajax({
                url: '/library/' + gameId,
                type: 'GET',
                success: function (response) {
                    $('#game').html(response);
                    // diplsay block
                    $('#game').css('display', 'block');
                }
            });
        });
    });
</script>