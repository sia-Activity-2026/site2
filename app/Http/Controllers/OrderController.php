a<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    use ApiResponser;
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        $orders = Order::all();
        return response()->json($orders, 200);
    }

    public function add(Request $request)
    {
        $rules = [
            'user_id' => 'required|exists:users,id',
            'product' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0'
        ];

        $this->validate($request, $rules);

        $order = Order::create($request->all());
        return response()->json($order, 201);
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        return response()->json($order, 200);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'user_id' => 'sometimes|exists:users,id',
            'product' => 'sometimes|string',
            'quantity' => 'sometimes|integer|min:1',
            'price' => 'sometimes|numeric|min:0'
        ];

        $this->validate($request, $rules);

        $order = Order::findOrFail($id);
        $order->update($request->all());
        return response()->json($order, 200);
    }

    public function delete($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return response()->json(['message' => 'Order deleted'], 200);
    }

    public function getUserOrders($userId)
    {
        $orders = Order::where('user_id', $userId)->get();
        return response()->json($orders, 200);
    }
}
