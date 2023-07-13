<div class="sidebar__item sidebar__item__color--option">
    <h4>Sort By Genre</h4>
    @foreach($data['genre'] as $value)
    <div class="sidebar__item__color sidebar__item__color--white">
        <label for="white">
            {{ $value['name'] }}
            <input type="radio" id="white">
        </label>
    </div>
    @endforeach
</div>
