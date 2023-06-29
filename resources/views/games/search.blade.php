<x-app-layout title="Search games" :basiclayout='true'>
<form action="{{ route('games.search') }}" method="GET" class="w-max">
    <input type="text" name="search" placeholder="Search by name" value="{{ old('search') }}">
    <input type="checkbox" name="on_sale" id="on_sale" {{ old('on_sale') ? 'checked' : '' }}>
    <label for="on_sale">On sale</label>

    <select name="sort">
        <option value="name" {{ old('sort') === 'name' ? 'selected' : '' }}>Sort by Name</option>
        <option value="price" {{ old('sort') === 'price' ? 'selected' : '' }}>Sort by Price</option>
        <option value="release_date" {{ old('sort') === 'release_date' ? 'selected' : '' }}>Sort by Release Date</option>
    </select>
    <input type="checkbox" name="order" id="order" {{ old('order') ? 'checked' : '' }}>
    <label for="order">Descending</label>
    

    <div class="flex flex-col">
    <input type="text" id="tagSearch" placeholder="Search tags...">
    <div class="tags-container h-64 overflow-x-hidden float-right">
        <div id="tagClones"></div>
        <div id="tagList">
            @foreach($tags as $tag)
                <div class="tag-checkbox">
                    <input type="checkbox" name="tags[]" id="tag{{ $tag->id }}" value="{{ $tag->name }}" {{ in_array($tag->name, old('tags', [])) ? 'checked' : '' }}>
                    <label for="tag{{ $tag->id }}">{{ $tag->name }}</label>
                </div>
            @endforeach
        </div>
    </div>
    </div>

    <x-primary-button>Search</x-primary-button>
</form>

<table class="table-auto border-separate border-spacing-2">
    <thead>
        <tr>
            <th></th>
            <th>Game</th>
            <th>Price</th>
            <th>Discount</th>
            <th>Release Date</th>
            <th>Developer</th>
            {{-- <th>Publisher</th> --}}
            @hasrole('admin')
                <th>Actions</th>
            @endhasrole
        </tr>
    </thead>
    <tbody>
        @foreach ($games as $game)
            <x-game-row :game="$game" />
        @endforeach
    </tbody>
</table>
{{ $games->appends(request()->query())->links() }}

</x-app-layout>

<script>
    $(document).ready(function(){
      // check for checked elements and put them on top
      $("#tagList .tag-checkbox input[type='checkbox']:checked").each(function() {
        var checkedItem = $(this).parent('.tag-checkbox');
        var clone = checkedItem.clone(true);
        var cloneID = $(this).attr("id") + "-clone";
        clone.attr("id", cloneID);
        $("#tagClones").prepend(clone);
      });


      $("#tagSearch").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#tagList .tag-checkbox").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    
      $("input[type='checkbox']").on("change", function() {
        var checkboxID = $(this).attr("id");
        var cloneID = checkboxID + "-clone";
        if (this.checked) {
          var checkedItem = $(this).parent('.tag-checkbox');
          var clone = checkedItem.clone(true);
          clone.attr("id", cloneID);
          $("#tagClones").prepend(clone);
        } else {
          $("#" + cloneID).remove();
        }
      });
    
      // When a clone checkbox is unchecked, also uncheck the original checkbox.
      $(document).on("change", ".tag-checkbox input[type='checkbox']", function() {
        var checkboxID = $(this).attr("id");
        var originalID = checkboxID.replace("-clone", "");
        if (!this.checked) {
          $("#" + originalID).prop("checked", false);
        }
      });
    });
</script>
    
    