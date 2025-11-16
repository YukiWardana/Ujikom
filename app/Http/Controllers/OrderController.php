<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Show all orders for current user
    public function index(Request $request)
    {
        $query = Order::with('orderItems.product')
            ->where('user_id', Auth::id());

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Sort by latest first
        $orders = $query->latest()->paginate(10);

        return view('orders.index', compact('orders'));
    }

    // Show single order detail
    public function show($id)
    {
        $order = Order::with(['orderItems.product', 'user'])
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('orders.show', compact('order'));
    }

    // Cancel order
    public function cancel($id)
    {
        $order = Order::where('id', $id)
            ->where('user_id', Auth::id())
            ->where('status', 'pending')
            ->firstOrFail();

        // Restore stock
        foreach ($order->orderItems as $item) {
            $item->product->increment('stock', $item->quantity);
        }

        // Update order status
        $order->update(['status' => 'cancelled']);

        return back()->with('success', 'Order cancelled successfully. Stock has been restored.');
    }
}