@extends('ecommerce.layouts.default')

@section('content')

    @include('ecommerce.includes.general.navbar')
    @include('ecommerce.includes.shop.breadcrumb')

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        @include('ecommerce.includes.shop.items')
                        @include('ecommerce.includes.shop.genre')
                        @include('ecommerce.includes.shop.types')
                        @include('ecommerce.includes.shop.price')
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">

                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            $(document).ready(function () {
                $('#catalogueSelect').on('change', function () {
                    let value = $(this).val();
                    value = value.split('_');
                    let selected = value[0];
                    let genre_id = value[1];

                    let selectedOption = $(this).find(':selected');
                    let selectedText = selectedOption.text();

                    window.location.href = (selected === '0') ? '/genres/' + genre_id : '/genres/' + genre_id + '?catalogue=' + selected + '&search=' + selectedText;
                });

                $('#priceRange').on('click', function () {
                    let minRange = $('#minamount').val();
                    let maxRange = $('#maxamount').val();

                    let currentUrl = window.location.href
                    if(currentUrl.includes('?')) {
                        window.location.href = currentUrl + '&min_price=' + minRange + '&max_price=' + maxRange;
                    } else {
                        window.location.href = currentUrl + '?min_price=' + minRange + '&max_price=' + maxRange;
                    }
                });
            });
        </script>
    @endpush

@stop
