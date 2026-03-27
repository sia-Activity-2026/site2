<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

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
        $orders = Order::with('user')->get();
        return response()->json($orders, 200);
    }

    public function getOrders()
    {
        $orders = DB::connection('mysql')
            ->select("SELECT * FROM orders");

        return $this->successResponse($orders);
    }

    public function add(Request $request)
    {
        $rule = [
            'user_id' => 'required | exists:users2,id',
            'total_amount' => 'required | numeric | min:0',
            'status' => 'in:pending,processing,completed,cancelled',
            'notes' => 'nullable | string | max:500'
        ];

        $this->validate($request, $rule);

        $orderData = $request->all();
        $orderData['order_number'] = 'ORD-' . strtoupper(Str::random(8));

        $order = Order::create($orderData);
        return $this->successResponse($order, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $order = Order::with('user')->findOrFail($id);
        return $this->successResponse($order);
    }

    public function update(Request $request, $id)
    {
        $rule = [
            'total_amount' => 'numeric | min:0',
            'status' => 'in:pending,processing,completed,cancelled',
            'notes' => 'nullable | string | max:500'
        ];

        $this->validate($request, $rule);

        $order = Order::findOrFail($id);
        $order->update($request->only(['total_amount', 'status', 'notes']));

        return $this->successResponse($order);
    }

    public function delete($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return $this->successResponse(['message' => 'Order deleted successfully']);
    }

    public function getUserOrders($userId)
    {
        $user = User::findOrFail($userId);
        $orders = $user->orders;
        return $this->successResponse($orders);
    }
}