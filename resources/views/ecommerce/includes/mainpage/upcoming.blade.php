<section class="from-blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title from-blog__title">
                    <h2>Upcoming Releases</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($data['catalogues'][1]['volumes'] as $item)
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="{{ asset($item['image_path']) }}" alt="item-image">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i>
                                    {{ \Carbon\Carbon::parse($item['release_data'])->format('F d, Y') }}</li>
{{--                                <li><i class="fa fa-comment-o"></i> 5</li>--}}
                            </ul>
                            <h5><a href="{{ route('item-info', ['id' => $item['id']]) }}">{{ $item['item']['title'] }}, {{ $item['title'] }}</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
