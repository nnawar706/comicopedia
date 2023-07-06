<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @if(count($data) == 0)
                    <p class="text-center">No Items Available.</p>
                @else
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                            <tr>
                                <th class="shoping__product">Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $row)
                                @php
                                    $discount = $row['discount'] ? (($row['price']*$row['discount'])/100) : 0;
                                @endphp
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="{{ asset($row->volume_image) }}" height="100" width="100" alt="product-image">
                                        <h5>{{ $row->item }}, {{ $row->volume }} - {{ $row->attribute_name }}</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        &#2547; {{ $row->price - $discount }}
                                        @if($row->attribute_name == 'Hardcover')
                                            <span style="color: #f30000"> (+ &#2547; 150)</span>
                                        @endif
                                        @if($row->discount)
                                            <p style="color: #f30000;font-size:11px">{{ $row->discount }}% discount applied</p>
                                        @endif
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        {{ $row->quantity }}
                                    </td>
                                    <td class="shoping__cart__total">
                                        @if($row->attribute_name == 'Hardcover')
                                            &#2547; {{ (($row->price - $discount)*$row->quantity)+(150*$row->quantity) }}
                                        @else
                                            &#2547; {{ ($row->price - $discount)*$row->quantity }}
                                        @endif
                                    </td>
                                    <td>
                                        <button style="display:inline-block;border:none"><a href="{{ route('delete-cart',['id' => $row->id]) }}" style="color: #f30000"><i class="fas fa-trash"></i></a></button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            @if(count($data) > 0)
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="{{ route('welcome') }}" class="primary-btn cart-btn">continue shopping</a>
                        <a href="{{ route('convert-wishlist') }}" class="primary-btn cart-btn cart-btn-right">convert to order</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
<!-- Shoping Cart Section End -->
