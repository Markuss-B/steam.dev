<div id="parallax">
    <img src="https://placehold.it/500x500" alt="">
    <img class="flip" src="https://placehold.it/500x500" alt="">
</div>
<div class="content">
    <div class="header">
        <div class="play">
            @if (Auth::user()->isPlaying($game))
                <form method="POST" action="{{ route('library.stop', ['game' => $game->id])}}">
                    @csrf
                    <button class="play-btn">&#9724;Stop</button>
                </form>
            @else
                <form method="POST" action="{{ route('library.play', ['game' => $game->id])}}">
                    @csrf
                    <button class="play-btn">&#9658;Play</button>
                </form>
            @endif
        </div>
        <ul class="stats">
            <li class="playtime">
                <i>&#9716;</i>
                <div>
                    <h3>Play time</h3>
                    <p id="gamehours">
                        @if ($game->pivot->play_time > 60)
                            {{ $game->pivot->play_time / 60 }} hours
                        @else
                            {{ $game->pivot->play_time }} minutes
                        @endif
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

    <div class="friends">
        <h2>Friends who own this game</h2>
        <div class="flex flex-row">
            @foreach (Auth::user()->friendsWithGame($game) as $friend)
                <x-user-card class="max-w-32 border ml-4" :user="$friend" />
            @endforeach
        </div>
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

<script>
    $(document).ready(function () {
        //Nosaka aktīvo bildīti
        var imgs_c = document.getElementById("images");
        console.log(imgs_c)
        var imgs = imgs_c.getElementsByTagName("img");
        for (var i = 0; i < imgs.length; i++) {
            imgs[i].addEventListener("click", function() {
                var current = imgs_c.getElementsByClassName("active");
                if (current.length != 0) {
                    current[0].className = current[0].className.replace(" active", "");
                }
                this.className += " active";
                showMedia(this);
            });
        }

        function showMedia(imgs) {
            // Get the media container
            var media = document.getElementById("media-container");
            media.innerHTML = "";
            // Create img element to append src otherwise element dissapears for some reason
            var img = document.createElement("img");
            img.src = imgs.src;
            // Use the same src in container as the image from the grid
            media.append(img);
        }
    })
</script>