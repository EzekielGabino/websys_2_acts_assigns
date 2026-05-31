<!DOCTYPE html>
<html>
<head>
    <title>Completed Orders</title>

    <style>
        body{
            font-family: Arial, sans-serif;
        }

        table{
            width:100%;
            border-collapse: collapse;
        }

        th, td{
            border:1px solid black;
            padding:8px;
            text-align:left;
        }

        th{
            background:#f2f2f2;
        }
    </style>
</head>
<body>

    <h2>Completed Orders Report</h2>

    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Product</th>
                <th>Total</th>
            </tr>
        </thead>

        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>@foreach ($order->items as $item)
                        <div>
                            <p>Name: {{ $item->products->name ?? 'No Product'}}</p>
                            <p>Price: {{ number_format($item->price, 2) }} pesos</p>
                            <p>Quantity: {{ $item->quantity }}x</p>
                        </div>
                    @endforeach</td>
                    <td>{{ $order->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>