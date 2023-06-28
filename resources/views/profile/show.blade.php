<x-app-layout title="Your profile" :basiclayout='true'>
    <x-profile-header :user="$user" />

    @auth
        @if ($user->id != Auth::id())
            {{-- add as friend --}}
            @if (Auth::user()->hasSentFriendRequestTo($user))
                <div class="mt-8 mb-4">
                    <h2 class="text-2xl font-semibold">
                        You have sent a friend request to {{ $user->name }}
                    </h2>
                    <form action="{{ route('cancelFriendRequest', $user) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-500 rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-600">
                            Cancel friend request
                        </button>
                    </form>
                </div>
            @elseif (Auth::user()->hasReceivedFriendRequestFrom($user))
                <div class="mt-8 mb-4">
                    <h2 class="text-2xl font-semibold">
                        {{ $user->name }} has sent you a friend request
                    </h2>
                    <form action="{{ route('acceptFriendRequest', $user) }}" method="POST">
                        @csrf
                        @method('PaTCH')
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-green-500 rounded-md hover:bg-green-600 focus:outline-none focus:bg-green-600">
                            Accept friend request
                        </button>
                    </form>
                    <form action="{{ route('declineFriendRequest', $user) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-500 rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-600">
                            Decline friend request
                        </button>
                    </form>
                </div>
            @elseif (Auth::user()->isFriendsWith($user))
                <div class="mt-8 mb-4">
                    <h2 class="text-2xl font-semibold">
                        You are friends with {{ $user->name }}
                    </h2>
                    <form action="{{ route('unfriend', $user) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-500 rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-600">
                            Unfriend
                        </button>
                    </form>
                </div>
            @elseif ($user->hasDeclinedFriendRequestFrom(Auth::user()))
                <div class="mt-8 mb-4">
                    <h2 class="text-2xl font-semibold">
                        {{ $user->name }} has declined your friend request
                    </h2>
                </div>
            @else
                <form action="{{ route('sendFriendRequest', $user) }}" method="POST">
                    @csrf
                    @method('POST')
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-green-500 rounded-md hover:bg-green-600 focus:outline-none focus:bg-green-600">
                        Add as friend
                    </button>
                </form>
            @endif
        @endif 
    @endauth
    
    @if ($user->friends->count() > 0)
        <div class="mt-8 mb-4">
            <h2 class="text-2xl font-semibold">
                @if ($user->id == Auth::id())
                    Your
                @else
                    {{ $user->name }}'s
                @endif
                friends
            </h2>
            <x-friends-list :friends="$user->friends" />
        </div>
    @else
        <div class="mt-8 mb-4">
            <h2 class="text-2xl font-semibold">
                @if ($user->id == Auth::id())
                    You don't have any friends yet
                @else
                    {{ $user->name }} doesn't have any friends yet
                @endif
            </h2>
        </div>
    @endif

    @if ($user->id != Auth::user()->id)
        @if ($user->hasGamesInCommonWith(Auth::user()))
            <div class="mt-8 mb-4">
                <h2 class="text-2xl font-semibold">
                    You have {{ $user->commonGames(Auth::user())->count() }} games in common with {{ $user->name }}
                </h2>
                <x-user-games-info :user="$user" :games="$user->commonGames(Auth::user())"/>
            </div>
        @endif
    @endif

    <div class="mt-8 mb-4">
        <h2 class="text-2xl font-semibold">
            @if ($user->id == Auth::id())
                Your
            @else
                {{ $user->name }}'s
            @endif
            games
        </h2>
    </div>

    <x-user-games-info :user="$user" />
</x-app-layout>