<x-app-layout title="Library">
    <x-slot name="styles">
        @vite('resources/css/library.css')
    </x-slot>
    <x-slot name="scripts">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    // Retrieve the last clicked game ID from session storage
    var lastClickedGameId = sessionStorage.getItem('lastClickedGame');

    // Highlight the last clicked game if it exists
    if (lastClickedGameId) {
        $('.game-l[data-id="' + lastClickedGameId + '"]').addClass('active');
        // Make the Ajax request to load the game details
        loadGameDetails(lastClickedGameId);
    }

    // Handle the click event on game elements
    $('.game-l').click(function () {
        var gameId = $(this).data('id');

        // Save the clicked game ID in session storage
        sessionStorage.setItem('lastClickedGame', gameId);

        // Remove the "active" class from other game elements
        $('.game-l').removeClass('active');

        // Add the "active" class to the clicked game element
        $(this).addClass('active');

        // Make the Ajax request to load the game details
        loadGameDetails(gameId);
    });

    // Function to load the game details
    function loadGameDetails(gameId) {
        $.ajax({
            url: '/library/' + gameId,
            type: 'GET',
            success: function (response) {
                $('#game').html(response);
                // diplsay block
                $('#game').css('display', 'block');
            }
        });
    }
});

</script>
