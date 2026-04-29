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
            <h4>Detalles del pedido</h4>
            <p>{{ $order->product_title }}</p>
        </div>
    </x-layout.layout>