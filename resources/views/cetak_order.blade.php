<!DOCTYPE html>
<html>

<head>
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }
    </style>
    <center>
        <h5>Laporan Penjualan Arshop</h4>
            <h6><a target="_blank" style="font-size: 10px;">PT Ecommerce Indonesia</a>
        </h5>
    </center>
     
    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No Order</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>Handphone</th>
                <th>Qty</th>
                <th>Profit</th>
                <th>Status pengiriman</th>
            </tr>
        </thead>
        <tbody>
            @foreach($list_order as $order)
            <tr>
                <!-- td  -->
                <td>{{$order->order_number}}</td>
                <td>{{$order->nama}}</td>
                <td>{{$order->email}}</td>
                <td>{{$order->alamat}}</td>
                <td>{{$order->phone}}</td>
                <td>{{$order->quantity}}</td>
                <td>Rp. {{number_format($order->total_amount,2)}}</td>
                <td>{{$order->status }}</td>
            </tr>
            @endforeach

        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" align="right"><strong>Total</strong></td>
                <td align="right"><strong>Rp. {{number_format($total_order,2)}}</strong></td>
                <td></td>
            </tr>
        </tfoot>
    </table>
     
</body>

</html>