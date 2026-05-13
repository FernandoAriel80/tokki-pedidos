    <x-layout.layout :name="$user['name']">

        @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="error-message">
            {{ session('error') }}
        </div>
        @endif

        <div class="order-container">
            <section class="btn-back">
                <a href="{{ url()->previous() }}">Volver</a>
            </section>
            <h3>Detalles del pedido</h3>
            <section class="order-container-section">
                <div class="order-title">
                    <p>{{ $order->product_title }}</p>
                </div>
                <div class="order-boddy-container">
                    <div>
                        <p><strong>Clinete:</strong> {{ $order->customer_name }}</p>
                        <p><strong>Precio:</strong> ${{ $order->price }}</p>
                        <p><strong>Fecha de entrega:</strong> {{ $order->delivery_date->format('d/m/Y') }}</p>
                        <p><strong>Producto entregado?</strong> {{ $order->is_finished == true ? "✅": "❌" }}</p>
                        @if ($order->is_finished)
                        <p><strong>Fecha de entregado:</strong> {{ $order->finished_date == null ? "" : $order->finished_date->format('d/m/Y')  }}</p>
                        @else
                        <p><strong>Fecha de entregado:</strong> No hay fecha</p>
                        @endif
                    </div>
                    <div>
                        <p><strong>Descripción:</strong></p>
                        <p class="order-description">{{ $order->description }}</p>
                    </div>
                </div>
                <div class="order-footer-container">
                    <p class="order-footer"><strong>Fecha de de creacion del pedido:</strong> {{ $order->created_at->format('d/m/Y') }}</p>
                    <div class="order-button">
                        <a href="/view-update/{{ $order->id }}">Actualizar</a>
                        <form action="/view-delete/{{ $order->id }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn-delete" onclick="return confirm('¿Seguro que queres eliminar este pedido?')">Eliminar</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </x-layout.layout>

    <style>
        .order-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            margin: 40px;
            gap: 40px;
            width: auto;
            text-align: center;
            background-color: #f8c5c5;
            padding: 40px;
            border-radius: 20px;
        }

        .order-title {
            padding: 10px;
            font-size: 40px;
        }

        .order-boddy-container {
            display: flex;
            justify-content: space-around;
            padding: 50px;
            text-align: left;
        }

        .order-boddy-container p {
            margin: 5px;
        }

        .order-footer {
            text-align: left;
        }

        .order-footer-container {
            display: flex;
            justify-content: space-between;
        }

        .order-button {
            display: flex;
            justify-content: space-around;
            gap: 30px;
        }

        .order-button a {
            border: 1px solid #f88080;
            padding: 5px;
            border-radius: 10px;
            color: #111;
            background-color: #fff;
            transition: all 0.4s ease;

        }

        .order-button a:hover {
            background-color: #f88080;
            color: #fff;
        }

        .btn-back {
            display: flex;
            width: 100%;
        }

        .btn-back a {
            padding: 10px;
            border: 1px solid #f88080;
            border-radius: 20px;
            background-color: #fff;
            color: #111;
        }

        .btn-delete {
            padding: 10px 15px;
            background-color: #fff;
            border-radius: 10px;
            color: #111;
            border: 1px solid #f88080;
            transition: all 0.4s ease;
        }

        .btn-delete:hover {
            background-color: #f88080;
            color: #fff;
            cursor: pointer;
        }

        .order-description {
            max-width: 500px;
            overflow: visible;
            overflow-wrap: break-word;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 12px 20px;
            border-radius: 8px;
            border-left: 4px solid #28a745;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .error-message {
            background-color: #d4edda;
            color: #571515;
            padding: 12px 20px;
            border-radius: 8px;
            border-left: 4px solid #a72828;
            margin-bottom: 20px;
            font-weight: 500;
        }
    </style>