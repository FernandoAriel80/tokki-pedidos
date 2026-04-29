<?php

namespace App\Http\Controllers;

use App\Http\Services\OrderService;
use App\Http\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController
{
    private UserService $userService;
    private OrderService $orderService;
    public function __construct()
    {
        $this->userService = new UserService();
        $this->orderService = new OrderService();
    }
    public function index()
    {
        try {
            $user = $this->userService->userHeader();
            return view('pages.order.create-order', [
                'user' => $user
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function oneOrder($id)
    {
        try {
            $user = $this->userService->userHeader();
            $order = $this->orderService->getOrderById($id);
            return view('pages.order.order-view', [
                'user' => $user,
                'order' => $order,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        //var_dump($request->all());
        $validated = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'customer' => 'required|string|min:2|max:255',
            'price' => 'required|numeric|min:0|max:999999.99',
            'description' => 'nullable|string|min:10|max:5000',
            'delivery_date' => 'required|date|after_or_equal:today|date_format:Y-m-d',
        ], [
            // Mensajes personalizados en español
            'title.required' => 'El nombre del producto es obligatorio.',
            'title.min' => 'El nombre del producto debe tener al menos :min caracteres.',
            'title.max' => 'El nombre del producto no puede superar los :max caracteres.',

            'customer.required' => 'El nombre del cliente es obligatorio.',
            'customer.min' => 'El nombre del cliente debe tener al menos :min caracteres.',
            'customer.max' => 'El nombre del cliente no puede superar los :max caracteres.',

            'price.required' => 'El precio es obligatorio.',
            'price.numeric' => 'El precio debe ser un número válido.',
            'price.min' => 'El precio no puede ser negativo.',
            'price.max' => 'El precio no puede superar los :max.',

            'description.min' => 'La descripción debe tener al menos :min caracteres.',
            'description.max' => 'La descripción no puede superar los :max caracteres.',

            'delivery_date.required' => 'La fecha de entrega es obligatoria.',
            'delivery_date.date' => 'Ingrese una fecha válida.',
            'delivery_date.after_or_equal' => 'La fecha de entrega debe ser hoy o una fecha futura.',
        ]);

        try {

            //var_dump($validated);
            $id = Auth::id();
            // var_dump($id);
            $this->orderService->createOrder($validated, $id);
            //var_dump($result);
            return redirect()->route('home')->with('success', 'Pedido creado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al crear el pedido: ' . $e->getMessage())
                ->withInput(); // Mantiene los datos ingresados
        }
    }
}
