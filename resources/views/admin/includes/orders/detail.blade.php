<div class="col-lg-8 col-md-8 col-sm-12" style="border: 1px solid #f1f1f1;">
    <div style="margin:20px 0 0 10px">
        <p>ID: #{{ $data['order_no'] }}</p>
        <hr>
        <table class="table table-borderless">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Item Name</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['items'] as $key => $item)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $item['volume']['item']['title'] }}, {{ $item['volume']['title'] }} - {{ $item['attribute']['name'] }}</td>
                    <td>{{ $item['price'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>{{ $item['total'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <hr>
    <div style="margin-left: 50%; margin-right:6%">
        <div class="d-flex">
            <div class="p-2 flex-grow-1"><p style="font-size: 13px">Sub Total</p></div>
            <div class="p-2">{{ $data['total'] }}</div>
        </div>
        <div class="d-flex">
            <div class="p-2 flex-grow-1"><p style="font-size: 13px">Shipping Cost</p></div>
            <div class="p-2"><p>{{ $data['shipping_cost'] }}</p></div>
        </div>
        @if (!is_null($data['is_promo']))
        <div class="d-flex">
            <div class="p-2 flex-grow-1"><p style="font-size: 13px">Discount<sup style="color: #f30000">*promo applied</sup></p></div>
            <div class="p-2"><p>{{ $data['promo_discount'] }}</p></div>
        </div>
        @endif
        <div class="d-flex">
            <div class="p-2 flex-grow-1"><p style="font-size: 13px">Total</p></div>
            <div class="p-2">{{ $data['total'] + $data['shipping_cost'] - $data['promo_discount'] }}</div>
        </div>
    </div>
    <hr>
    <p><span style="font-size:13px">Remarks: </span><br>
            {{ $data['user_comment'] }}</p>
</div>
