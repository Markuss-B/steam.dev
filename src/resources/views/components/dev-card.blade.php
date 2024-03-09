<div class="dev-card group w-32 group ml-12 mr-12 mb-6 cursor-pointer relative"
    onclick="window.location.href='{{ route('developers.show', ['developer' => $dev->id]) }}'">
    <div class="dev-card-image w-32 h-32 rounded-lg shadow-md overflow-hidden">
        <img src="https://picsum.photos/500/500" alt="Placeholder Image" class="object-cover rounded-t-lg">
    </div>
    <div class="devname">
        <h3 class="text-l text-black group-hover:font-bold">{{ $dev->name }}</h3>
    </div>
</div>