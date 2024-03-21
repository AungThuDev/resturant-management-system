<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reciept</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            padding: 20px;
        }

        img {
            width: 150px;
            border-radius: 50%;
            justify-content: center
        }

        h5 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h2,
        h3 {
            margin-top: 20px;
            text-align: center;
        }

        h3 {
            font-style: italic;
        }
    </style>
</head>

<body>
    <h3>York Cafe</h3>
    <h3>Sincerely,</h3>
    <h3>Thanks You!</h3>
    <h5>Order ID - {{ $order_id }}</h5>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Taste</th>
                <th>Price</th>
                <th>Qty</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order_details as $detail)
                <tr>
                    <td>{{ $detail['name'] }}</td>
                    <td>{{ $detail['taste'] }}</td>
                    <td>{{ $detail['price'] }} MMK</td>
                    <td>{{ $detail['qty'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br><br>
    <h2>Sub - {{ $total }} MMK</h2>
    <h2>Grand - {{ $discounted_amount }} MMK </h2>
    <h3>including tax 10 %</h3>

    <h3>Please Come Again! We will offer you great service</h3>
</body>

</html>
