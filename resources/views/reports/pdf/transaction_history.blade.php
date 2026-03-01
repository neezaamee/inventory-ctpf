<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Transaction History Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
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
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .type-in {
            color: green;
        }
        .type-out {
            color: red;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>City Traffic Police Faisalabad</h2>
        <h3>Wardi Godown Branch - Transaction History Log</h3>
        <p>Generated on: {{ date('Y-m-d H:i:s') }}</p>
        @if(request('start_date') && request('end_date'))
            <p>Filtered Period: {{ request('start_date') }} to {{ request('end_date') }}</p>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>Date / Time</th>
                <th>Type</th>
                <th>Item Details</th>
                <th>Quantity</th>
                <th>Officer (Belt No)</th>
                <th>OpUser</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $tx)
                <tr>
                    <td>{{ $tx->created_at->format('Y-m-d H:i') }}</td>
                    <td class="{{ $tx->type == 'in' ? 'type-in' : 'type-out' }}">
                        {{ strtoupper($tx->type) }}
                    </td>
                    <td>{{ $tx->variation->item->name }} ({{ $tx->variation->value }})</td>
                    <td>{{ $tx->quantity }}</td>
                    <td>{{ $tx->officer ? $tx->officer->name . ' (' . $tx->officer->belt_number . ')' : '--' }}</td>
                    <td>{{ $tx->user->name ?? 'System' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">No transactions recorded.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
