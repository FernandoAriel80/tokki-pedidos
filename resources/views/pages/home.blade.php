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
        @if ($user['is_authorized'])
        <div class="btn-nav">
            <a href="/create-order"><button class="btn-create-order">Crear pedido</button></a>
        </div>

        <x-common.home.orders-search :search="request('search')" />
        @if($orders->count() > 0)
        <x-common.home.orders-list :orders="$orders" />
        @else
        <div class="no-results">
            <p>No se encontraron resultados.</p>
        </div>
        @endif
        @else
        <h1>Bienvenido</h1>
        <span>Esta registrado pero no autorizado por el admin.</span>
        @endif
    </x-layout.layout>

    <style>
        .btn-nav {
            padding-bottom: 10px;
        }

        .btn-create-order {
            padding: 10px;
            border-radius: 10px;
            background-color: #f88080;
            color: #fff;
            border: none;
            cursor: pointer;
            margin: 30px;
            transition: all 0.4s ease;
        }

        .btn-create-order:hover {
            background-color: #f88080;
            transform: translateY(-2px);
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

        .no-results {
            text-align: center;
            padding: 50px;
            color: #666;
            font-size: 16px;
        }
    </style>