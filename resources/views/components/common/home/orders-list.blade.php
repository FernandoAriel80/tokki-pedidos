@props(['orders'])

<section class="orders-select">
    <div class="orders-container">
        <table>
            <thead class="orders-header-table">
                <tr>
                    <th>Producto</th>
                    <th>N° Cliente</th>
                    <th>Precio</th>
                    <th>Entregado?</th>
                    <th>Fecha de entrega</th>
                    <th>Fecha de creacion</th>
                    <th>Detalles</th>
                </tr>
            </thead>
            <tbody class="orders-body-table">
                @foreach ( $orders as $order)
                <tr>
                    <td>{{ $order->product_title }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>${{ $order->price }}</td>
                    <td>{{ $order->is_finished == true ? "✅": "❌" }}</td>
                    <td>{{ $order->delivery_date->timezone('America/Argentina/Buenos_Aires')->format('d/m/Y') }}</td>
                    <td>{{ $order->created_at->timezone('America/Argentina/Buenos_Aires')->format('d/m/Y') }}</td>
                    <td class="btn-more"><a href="/view-order/{{ $order->id }}">info</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination-container">
            @if ($orders->hasPages())
            <div class="pagination-links">
                {{ $orders->appends(request()->query())->links() }}
            </div>
            @endif
        </div>
    </div>


</section>

<style>
    .orders-select {
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .orders-container {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        border: 1px solid #f88080;
        min-height: 500px;
        padding: 20px;
        width: 900px;
    }

    .orders-header-table {
        background-color: #f88080;
    }

    .orders-header-table tr th {
        padding: 5px;
        text-align: center;
        color: #fff;
    }

    .orders-body-table {}

    .orders-body-table tr td {
        padding: 5px;
        text-align: center;
        border-bottom: 1px solid #f88080;
        max-width: 150px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }


    .pagination-container {
        margin-top: 40px;
        padding: 20px;
        background: #f9f9f9;
        border-radius: 12px;
    }

    .pagination-info {
        text-align: center;
        gap: 10px;
        margin-bottom: 15px;
        color: #666;
        font-size: 14px;
    }

    .pagination-info span {
        font-weight: bold;
        color: #fd5d5d;
    }

    .pagination-links nav {
        display: flex;
        justify-content: center;
    }

    .pagination-links .pagination {
        display: flex;
        gap: 10px;
        list-style: none;
        padding: 0;
    }

    .btn-more a {
        color: #fff;
        border-radius: 5px;
        background-color: #f88080;
        padding: 5px;
        transition: all 0.4s ease;
    }


    .btn-more a:hover {
        color: #f88080;
        background-color: #fff;
    }
</style>