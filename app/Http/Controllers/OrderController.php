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
        } catch (\Exception $th) {
            return back()->withErrors([
                'error' => 'Ocurrió un error al procesar tu solicitud.'
            ])->withInput();
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
        } catch (\Exception $th) {
            return back()->withErrors([
                'error' => 'Ocurrió un error al procesar tu solicitud.'
            ])->withInput();
        }
    }

    public function store(Request $request)
    {

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
                ->with('error', 'Error al crear el pedido: ')
                ->withInput(); // Mantiene los datos ingresados
        }
    }


    public function update($id)
    {
        try {
            $user = $this->userService->userHeader();
            $order = $this->orderService->getOrderById($id);
            return view('pages.order.update-order', [
                'user' => $user,
                'order' => $order,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al obtener el pedido: ')
                ->withInput(); // Mantiene los datos ingresados
        }
    }

    public function save(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'customer' => 'required|string|min:2|max:255',
            'price' => 'required|numeric|min:0|max:999999.99',
            'description' => 'nullable|string|min:10|max:5000',
            'delivery_date' => 'required|date|date_format:Y-m-d',
            'is_finished' => 'sometimes|boolean|in:0,1',
            'finished_date' => 'nullable|date|date_format:Y-m-d',
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

            'finished_date.date' => 'Ingrese una fecha válida.',
        ]);

        try {
            $this->orderService->updateOrder($id, $validated);
            //var_dump($request->all());
            return redirect()->route('orderView', ['id' => $id])->with('success', 'Pedido actualizado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al actualizar el pedido: ')
                ->withInput(); // Mantiene los datos ingresados
        }
    }

    public function delete($id)
    {
        try {

            $this->orderService->deleteOrder($id);
            return redirect()->route('home')->with('success', 'Pedido eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al actualizar el pedido: ')
                ->withInput(); // Mantiene los datos ingresados
        }
    }
}
