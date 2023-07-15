<div class="sidebar__item">
    <h4>Top Manga List</h4>
    <ul>
        @foreach($data['items'] as $item)
            <li><a href="{{ route('item-info',['id' => $item->id]) }}">{{ $item->title }} - <span style="color: darkgray">{{ $item->volume_list_count }} Volumes</span></a></li>
        @endforeach
    </ul>
</div>
