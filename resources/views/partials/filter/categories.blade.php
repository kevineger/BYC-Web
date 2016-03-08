<div class="menu">
    <div class="ui form">
        <div class="grouped fields">
            <a class="item">
                <div class="ui checkbox">
                    {{--If no categories were specified, check All--}}
                    @if(!Input::old('categories'))
                        <input name="all_cat" onclick="allCategories()" type="checkbox" id="all_cat"
                               checked="checked">
                    @else
                        <input onclick="allCategories()" type="checkbox" id="all_cat">
                    @endif
                    <label>All</label>
                </div>
            </a>
            @foreach($categories as $category)
                <a class="item">
                    <div class="ui checkbox">
                        @if(in_array($category->text, Input::old('categories', [])))
                            {{--TODO: Figure out non-disgusting way to do this--}}
                            <input onclick="specificCategories()" type="checkbox"
                                   name="categories[]"
                                   value="{{ $category->text }}" class="category" checked>
                        @else
                            <input onclick="specificCategories()" type="checkbox"
                                   name="categories[]"
                                   value="{{ $category->text }}" class="category">
                        @endif
                        <label>{{ $category->text }}</label>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>