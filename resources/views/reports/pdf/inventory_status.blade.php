<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Inventory Status Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h2 {
            margin: 0;
            padding: 0;
        }
        .header p {
            margin: 5px 0;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .text-danger {
            color: red;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>City Traffic Police Faisalabad</h2>
        <h3>Wardi Godown Branch - Inventory Status Report</h3>
        <p>Generated on: {{ date('Y-m-d H:i:s') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Category</th>
                <th>Item Name</th>
                <th>Variation / Size</th>
                <th>Current Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach($variations as $var)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $var->item->category->name }}</td>
                    <td>{{ $var->item->name }}</td>
                    <td>{{ $var->value }}</td>
                    <td class="{{ $var->stock_quantity <= $var->item->min_stock_threshold ? 'text-danger' : '' }}">
                        {{ $var->stock_quantity }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
