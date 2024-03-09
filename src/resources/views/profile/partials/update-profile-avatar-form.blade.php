<section>
    <header>
        <img src="{{ asset('storage/'.$user->avatar) }}" alt="avatar" class="w-20 h-20 rounded-full">

        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Avatar') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's avatar.") }}
        </p>
    </header>

    <form action="{{ route('profile.updateAvatar') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('patch')
    
        <div>
            <label for="avatar">Avatar</label>
            <input type="file" id="avatar" name="avatar">
        </div>
    
        <button type="submit">Update Avatar</button>
    </form>
    
</section>