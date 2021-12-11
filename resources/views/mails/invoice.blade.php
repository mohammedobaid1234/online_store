<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3>Invoice # {{ $order->number }}</h3>
    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>Price</th>
                <th>Quantity</th>
                <td>Total</td>
            </tr>
        </thead>
        @foreach ($order->items as $item)
            <tr>
                <td>{{$item->product->name}}</td>
                <td>{{$item->price}}</td>
                <td>{{$item->quantity}}</td>
                <td>{{$item->quantity * $item->price}}</td>
            </tr>
            <tfoot>
                <tr>
                    <td colspan="3">Total</td>
                    <td>{{$order->total}}</td>
                </tr>
            </tfoot>
        @endforeach
    </table>
</body>
</html>