<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $order->order_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #333;
            line-height: 1.3;
            margin: 0;
            padding: 15px;
        }
        .header {
            text-align: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #2563eb;
        }
        .header h1 {
            margin: 0 0 3px 0;
            color: #2563eb;
            font-size: 20px;
        }
        .header p {
            margin: 2px 0;
            color: #666;
            font-size: 11px;
        }
        .info-section {
            margin-bottom: 12px;
        }
        .info-section h3 {
            background-color: #2563eb;
            color: white;
            padding: 5px 8px;
            margin: 0 0 6px 0;
            font-size: 12px;
        }
        .info-row {
            margin-bottom: 3px;
        }
        .info-label {
            display: inline-block;
            width: 130px;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        table th {
            background-color: #2563eb;
            color: white;
            padding: 6px 8px;
            text-align: left;
            font-size: 11px;
        }
        table td {
            padding: 6px 8px;
            border-bottom: 1px solid #ddd;
        }
        table tr:last-child td {
            border-bottom: none;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .summary {
            margin-top: 10px;
            float: right;
            width: 280px;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 3px 0;
            font-size: 11px;
        }
        .summary-row.total {
            font-size: 14px;
            font-weight: bold;
            border-top: 2px solid #2563eb;
            padding-top: 6px;
            margin-top: 6px;
            color: #2563eb;
        }
        .footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
            text-align: center;
            color: #666;
            font-size: 9px;
        }
        .stamp {
            margin-top: 15px;
            text-align: right;
            font-weight: bold;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>Toko Alat Kesehatan</h1>
        <p>Laporan Belanja Anda</p>
    </div>

    <!-- Invoice Info -->
    <div class="info-section">
        <h3>Invoice Information</h3>
        <div class="info-row">
            <span class="info-label">Order Number:</span>
            <span>{{ $order->order_number }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Date:</span>
            <span>{{ $order->created_at->format('d M Y, H:i') }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Status:</span>
            <span style="text-transform: capitalize;">{{ $order->status }}</span>
        </div>
    </div>

    <!-- Customer Info -->
    <div class="info-section">
        <h3>Customer Information</h3>
        <div class="info-row">
            <span class="info-label">Name:</span>
            <span>{{ $order->user->username }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Email:</span>
            <span>{{ $order->user->email }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Contact:</span>
            <span>{{ $order->user->contact_no }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Address:</span>
            <span>{{ $order->shipping_address }}</span>
        </div>
    </div>

    <!-- Payment Info -->
    <div class="info-section">
        <h3>Payment Information</h3>
        <div class="info-row">
            <span class="info-label">ID PayPal:</span>
            <span>{{ $order->user->paypal_id ?? '-' }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Bank Name:</span>
            <span>{{ $order->payment_type ? ucwords(str_replace('_', ' ', $order->payment_type)) : '-' }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Payment Method:</span>
            <span style="text-transform: capitalize;">{{ $order->payment_method }}</span>
        </div>
    </div>

    <!-- Order Items -->
    <h3 style="background-color: #2563eb; color: white; padding: 5px 8px; margin: 12px 0 6px 0; font-size: 12px;">Order Items</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center" style="width: 40px;">No</th>
                <th>Product Name</th>
                <th class="text-center" style="width: 70px;">Quantity</th>
                <th class="text-right" style="width: 100px;">Price</th>
                <th class="text-right" style="width: 100px;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderItems as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item->product->name }}</td>
                <td class="text-center">{{ $item->quantity }}</td>
                <td class="text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Order Summary -->
    <div class="summary">
        <div class="summary-row">
            <span>Subtotal:</span>
            <span>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
        </div>
        <div class="summary-row">
            <span>Tax (11%):</span>
            <span>Rp {{ number_format($order->tax, 0, ',', '.') }}</span>
        </div>
        <div class="summary-row total">
            <span>Total:</span>
            <span>Rp {{ number_format($order->total_amount + $order->tax, 0, ',', '.') }}</span>
        </div>
    </div>

    <div style="clear: both;"></div>

    <!-- Signature -->
    <div class="stamp">
        <p style="margin-bottom: 50px;">TANDATANGAN TOKO</p>
        <p style="border-top: 1px solid #333; padding-top: 3px; display: inline-block; min-width: 180px; font-size: 10px;">
            Authorized Signature
        </p>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; {{ date('Y') }} Toko Alat Kesehatan. All rights reserved.</p>
        <p>This is a computer-generated invoice and does not require a physical signature.</p>
    </div>
</body>
</html>