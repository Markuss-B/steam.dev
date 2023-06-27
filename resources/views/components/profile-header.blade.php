<div class="profile-header flex">
    <!-- An unexamined life is not worth living. - Socrates -->
    <div class="profile-avatar">
        <img src="{{ $avatar }}" alt="{{ $name }}"
            class="w-32 rounded-lg shadow-lg">
    </div>
    <div class="profile-info ml-4">
        <div class="profile-name">
            <h5 class="mb-2 text-xl font-medium leading-tight">
                {{ $name }}
            </h5>
        </div>
        <div class="profile-description">
            <p class="text-neutral-500">
                {{ $description }}
            </p>
        </div>
    </div>
</div>