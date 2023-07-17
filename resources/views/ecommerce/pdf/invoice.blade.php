<html>
<head>
    <title>
        Order Invoice | {{ $order['order_no'] }}
    </title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            text-align: left;
            padding: 10px;
        }
    </style>
</head>
<body>
<section>
    <div style="float: left; margin-top: 20px;width: 370px;">
        <b style="font-size: 20px">Issued To:</b>
        <p style="font-size: 15px">Customer: {{ $order['user']['name'] }}</p>
        <p style="font-size: 15px">Email: {{ $order['user']['email'] }}</p>
        <p style="font-size: 15px">Contact: {{ $order['contact'] }}</p>
        <p style="font-size: 15px">Shipping Address: {{ $order['address']['address'] }}</p>
        <p style="font-size: 15px">Ordered On: {{ \Carbon\Carbon::parse($order['created_at'])->format('F d, Y') }}</p>
    </div>
    <div style="float: right">
        <img style="height: 80px" src="{{ public_path($general['logo_path']) }}">
        <p style="font-size: 13px"><b>{{ $general['name'] }}</b></p>
        <p style="font-size: 12px">Contact: {{ $general['contact'] }}</p>
        <p>
            <b>#Order ID: </b>{{ $order['order_no'] }}
        </p>
    </div>
</section>

<div style="background-color: brown; height: 1px; width: 100%; margin-top: 260px"></div>

<section style="margin-top: 50px">
    <table>
        <tr style="background-color: #374151;color: #fff;">
            <td>#ID</td>
            <td>Item Name</td>
            <td>Quantity</td>
            <td>Price(Tk)</td>
            <td>Amount(Tk)</td>
        </tr>

        @foreach($order['items'] as $item)

            <tr class="table_body">
                <td>{{ $item['volume']['product_unique_id'] }}</td>
                <td style="color: #000">{{ $item['volume']['item']['title'] }}, {{ $item['volume']['title'] }} - {{ $item['attribute']['name'] }}</td>
                <td>{{ $item['quantity'] }}</td>
                <td>{{ $item['price'] - $item['discount'] }}</td>
                <td>{{ $item['total'] }}</td>
            </tr>

        @endforeach
    </table>
    <div style="background-color: #374151; height: 1px; width: 100%;"></div>
    <div style="float: right; margin-right: 27px">
        <p>
            <span style="margin-right: 140px">Subtotal</span> Tk {{ $order['total'] }}<br>
            @if($order['promo_discount'] !== 0)
            <span style="margin-right: 135px">Discount</span> Tk {{ $order['promo_discount'] }}<br>
            @endif
            <span style="margin-right: 102px">Shipping Cost</span> Tk {{ $order['shipping_cost'] }}<br>
            <span style="margin-right: 160px">Total</span> Tk {{ $order['total'] - $order['promo_discount'] + $order['shipping_cost'] }}
        </p>
    </div>
</section>
<section style="position: absolute; bottom: 0; width: 100%">
    <div style="background-color: brown; height: 1px; width: 100%"></div>
    <p>Email: <span>{{ $general['email'] }}</span><br>Contact: {{ $general['contact'] }}</p>
</section>
</body>
</html>
