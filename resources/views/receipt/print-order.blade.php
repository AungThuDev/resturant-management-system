<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Order</title>
    <style>
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
    </style>
</head>

<body>
    <table class="table">
        <thead>
            <tr>
                <th>Recipe Name</th>
                <th>Qty</th>
                <th>Taste</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kitchen as $k)
                <tr>
                    <td>{{ $k['recipe_name'] }}</td>
                    <td>{{ $k['quantity'] }}</td>
                    <td>{{ $k['taste'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
