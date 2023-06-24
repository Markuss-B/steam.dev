<div id="parallax">
    <img src="https://placehold.it/500x500" alt="">
    <img class="flip" src="https://placehold.it/500x500" alt="">
</div>
<div class="content">
    <div class="header">
        <div class="play">
            <button class="play-btn">&#9658;Play</button>
        </div>
        <ul class="stats">
            <li class="playtime">
                <i>&#9716;</i>
                <div>
                    <h3>Play time</h3>
                    <p id="gamehours">
                        {{ $game->pivot->play_time }}
                    </p>
                </div>
            </li>
            <li class="achievements">
                <i>&#9813;</i>
                <div>
                    <h3>Achievements</h3>
                    <progress id="achvbar" value="32" max="100"></progress>
                </div>
            </li>
        </ul>
    </div>
    <div class="nav">
        <ul>
            <li><a href="{{ route('games.show', ['game' => $game->id]) }}">Store</a></li>
            <li><a href="#">Community Hub</a></li>
            <li><a href="#">Find Groups</a></li>
            <li><a href="#">Discussions</a></li>
            <li><a href="#">Guides</a></li>
            <li><a href="#">Workshop</a></li>
            <li><a href="#">Support</a></li>
        </ul>
    </div>
    <div class="about">
        <div class="info">
            <h1 id="gametitle">{{ $game->name }}</h1>
            <span class="line"></span>
            <h2>About this game</h2>
            <span class="line2"></span>
            <p>
                {{ $game->description }}
            </p>
        </div>
        <div class="media">
            <h2>Media</h2>
            <span class="line2"></span>
            <div class="container">
                <div id="media-container">
                    <img src="https://steamcdn-a.akamaihd.net/steam/apps/440/0000002581.jpg" alt="">                                </div>
                <div id="images">
                    <img src="https://steamcdn-a.akamaihd.net/steam/apps/440/0000002581.jpg" alt="">
                    <img src="https://steamcdn-a.akamaihd.net/steam/apps/440/ss_e3aedb2ab36bba8cfe611b1e0eaa807e4bb2d742.1920x1080.jpg?t=1592263852" alt="">
                    <img src="https://steamcdn-a.akamaihd.net/steam/apps/440/ss_ee24a769dc1d81dcbd7b250d16530394adee4264.1920x1080.jpg?t=1592263852" alt="">
                    <img src="https://steamcdn-a.akamaihd.net/steam/apps/440/ss_9faaa506d91bf19dbb398e0c06a684b337f85f91.1920x1080.jpg?t=1592263852" alt="">
                    <img src="https://steamcdn-a.akamaihd.net/steam/apps/440/ss_ea21f7bbf4f79bada4554df5108d04b6889d3453.1920x1080.jpg?t=1592263852" alt="">
                    <img src="https://steamcdn-a.akamaihd.net/steam/apps/440/0000002581.jpg" alt="">
                    <img src="https://steamcdn-a.akamaihd.net/steam/apps/440/0000002581.jpg" alt="">
                    <img src="https://steamcdn-a.akamaihd.net/steam/apps/440/0000002581.jpg" alt="">
                    <img src="https://steamcdn-a.akamaihd.net/steam/apps/440/0000002581.jpg" alt="">
                    <img src="https://steamcdn-a.akamaihd.net/steam/apps/440/0000002581.jpg" alt="">
                    <img src="https://steamcdn-a.akamaihd.net/steam/apps/440/0000002581.jpg" alt="">
                    <img src="https://steamcdn-a.akamaihd.net/steam/apps/440/0000002581.jpg" alt="">
                    <img src="https://steamcdn-a.akamaihd.net/steam/apps/440/0000002581.jpg" alt="">
                    <img src="https://steamcdn-a.akamaihd.net/steam/apps/440/0000002581.jpg" alt="">
                    <img src="https://steamcdn-a.akamaihd.net/steam/apps/440/0000002581.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</div>