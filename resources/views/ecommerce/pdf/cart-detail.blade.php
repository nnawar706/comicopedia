<html>
<head>
    <title>
        Cart Information | {{ $title }}
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
    <div style="float: left; margin-top: 20px">
        <b style="font-size: 20px">Issued To:</b>
        <p style="font-size: 17px">Customer ID: {{ $title }}</p>
    </div>
    <div style="float: right">
        <img style="height: 80px" src="{{ public_path($general['logo_path']) }}">
        <p style="font-size: 13px"><b>{{ $general['name'] }}</b></p>
        <p style="font-size: 12px">Contatct: {{ $general['contact'] }}</p>
        <p>
            <b>#Cart No: </b>{{ substr($title, 4) }}
        </p>
    </div>
</section>

<div style="background-color: brown; height: 1px; width: 100%; margin-top: 170px"></div>

<section style="margin-top: 30px">
    <table>
        <tr style="background-color: #374151;color: #fff;">
            <td>Item Name</td>
            <td>Quantity</td>
            <td>Price(Tk)</td>
            <td>Amount(Tk)</td>
        </tr>

            @php
                $total = 0;
            @endphp

            @foreach($cart as $item)

            @php
                $cart_total = $item['discount'] ? (($item['price'] - (($item['price'] * $item['discount']) / 100)) * $item['quantity']) : ($item['price'] * $item['quantity']);

                if($item['attribute_name'] == 'Hardcover')
                {
                    $cart_total += 150;
                }

                $total += $cart_total;
            @endphp

            <tr class="table_body">
                <td style="color: #000">{{ $item['item'] }}, {{ $item['volume'] }} - {{ $item['attribute_name'] }}</td>
                <td>{{ $item['quantity'] }}</td>
                <td>{{ $item['attribute_name'] == 'Hardcover' ?
                    ($item['discount'] ? (($item['price']-(($item['price']*$item['discount'])/100))+150) : ($item['price']+150)) :
                    ($item['discount'] ? ($item['price']-(($item['price']*$item['discount'])/100)) : $item['price']) }}</td>
                <td>{{ $cart_total }}</td>
            </tr>

            @endforeach
    </table>
    <div style="background-color: #374151; height: 1px; width: 100%;"></div>
    <div style="float: right; margin-right: 27px">
        <p>
            <span style="margin-right: 140px">Subtotal</span> Tk {{ $total }}<br>
        </p>
    </div>
</section>
<section style="position: absolute; bottom: 0; width: 100%">
    <div style="background-color: brown; height: 1px; width: 100%"></div>
    <p>Email: <span>{{ $general['email'] }}</span><br>Contact: {{ $general['contact'] }}</p>
</section>
</body>
</html>
