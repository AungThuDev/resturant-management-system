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
    <img src="{{ asset('assets/img/brand/logo.webp') }}"
        style="width: 150px; border-radius: 50%;justify-content: center;margin-left: 20px" alt="">

    <h5>Order ID - {{ $receipt->order_id }}</h5>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Taste</th>
                <th>Per</th>
                <th>Qty</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order_details as $detail)
                <tr>
                    @foreach ($detail->recipes as $recipe)
                        <td>{{ $recipe->name }}</td>
                    @endforeach
                    <td>{{ $detail->taste }}</td>
                    <td>{{ $detail->amount }} MMK</td>
                    <td>{{ $detail->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br><br>
    <h2>Sub - {{ $receipt->amount }} MMK</h2>
    <h2>Grand - {{ $receipt->discounted_amount }} MMK </h2>
    <h3>including tax 10 %</h3>

    <h3>Please Come Again! We will offer you great service</h3>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function afterPrint() {
                window.location.href = "/dinning-plans";
            }

            // Attach event listeners
            window.onafterprint = afterPrint;

            // Trigger the print dialog
            window.print();
        });
    </script>
</body>

</html>
