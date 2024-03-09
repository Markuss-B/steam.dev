{{-- friends list uses user-card --}}
<div class="flex flex-col">
    @foreach ($friends as $friend)
        <x-user-card :user="$friend">
        </x-user-card>
    @endforeach
</div>