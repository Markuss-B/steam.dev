{{-- to this view are passed 'friends', 'requests', 'sentRequests', 'declinedRequests' --}}
{{-- also use user-card and in the slot define the forms for accepting/declining friendships --}}
<x-app-layout title="Friendships" :basiclayout='false'>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <form action="{{ route('users.index') }}" method="GET">
            <x-search-bar />
        </form>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-6 gap-6">
            <div class="col-span-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="space-y-3">
                            <h2 class="text-lg font-semibold">Friends</h2>
                            <div class="space-y-3">
                                @forelse (Auth::user()->friends as $friend)
                                    <x-user-card :user="$friend">
                                        <form action="{{ route('unfriend', $friend->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')	
                                            <button type="submit" class="text-sm text-red-500 hover:text-red-700">Remove</button>
                                        </form>
                                    </x-user-card>
                                @empty
                                    You are not very friendly..
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-2">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 space-y-6">
                        <div class="space-y-3">
                            <h2 class="text-lg font-semibold">Friend requests</h2>
                            <div class="space-y-3">
                                @forelse (Auth::user()->pendingFriendsFrom as $request)
                                    <x-user-card :user="$request">
                                        <form action="{{ route('acceptFriendRequest', $request->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')	
                                            <button type="submit" class="text-sm text-green-500 hover:text-green-700">Accept</button>
                                        </form>
                                        <form action="{{ route('declineFriendRequest', $request->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')	
                                            <button type="submit" class="text-sm text-red-500 hover:text-red-700">Decline</button>
                                        </form>
                                    </x-user-card>
                                @empty
                                    No friend requests
                                @endforelse
                            </div>
                        </div>

                        <div class="space-y-3">
                            <h2 class="text-lg font-semibold">Pending friend requests</h2>
                            <div class="space-y-3">
                                @forelse (Auth::user()->pendingFriendsTo as $pending)
                                    <x-user-card :user="$pending">
                                        <form action="{{ route('cancelFriendRequest', $pending->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')	
                                            <button type="submit" class="text-sm text-green-500 hover:text-green-700">Cancel</button>
                                        </form>
                                    </x-user-card>
                                @empty
                                    No pending friend requests
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>       
</x-app-layout>