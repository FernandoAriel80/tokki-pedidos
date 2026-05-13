@props(['orders'])

<section class="orders-select">
    <div class="orders-container">
        <table class="orders-table">
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
                @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->product_title }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>${{ $order->price }}</td>
                    <td>{{ $order->is_finished == true ? "✅" : "❌" }}</td>
                    <td>{{ $order->delivery_date->timezone('America/Argentina/Buenos_Aires')->format('d/m/Y') }}</td>
                    <td>{{ $order->created_at->timezone('America/Argentina/Buenos_Aires')->format('d/m/Y') }}</td>
                    <td class="btn-more"><a href="/view-order/{{ $order->id }}">info</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if ($orders->hasPages())
        <div class="pagination-container">
            <div class="pagination-links">
                @if ($orders->onFirstPage())
                <span class="pagination-btn disabled">← Anterior</span>
                @else
                <a href="{{ $orders->previousPageUrl() }}" class="pagination-btn">← Anterior</a>
                @endif

                <div class="pagination-numbers">
                    @foreach ($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                    @if ($page == $orders->currentPage())
                    <span class="pagination-btn active">{{ $page }}</span>
                    @else
                    <a href="{{ $url }}" class="pagination-btn">{{ $page }}</a>
                    @endif
                    @endforeach
                </div>

                @if ($orders->hasMorePages())
                <a href="{{ $orders->nextPageUrl() }}" class="pagination-btn">Siguiente →</a>
                @else
                <span class="pagination-btn disabled">Siguiente →</span>
                @endif
            </div>

            <div class="pagination-info">
                Página <strong>{{ $orders->currentPage() }}</strong> de <strong>{{ $orders->lastPage() }}</strong>
                | Total: <strong>{{ $orders->total() }}</strong> registros
            </div>
        </div>
        @endif
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
        padding: 10px;
        text-align: center;
        color: #fff;
    }

    .orders-body-table tr td {
        padding: 10px;
        text-align: center;
        border-bottom: 1px solid #f88080;
        max-width: 150px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .btn-more a {
        color: #fff;
        border-radius: 5px;
        background-color: #f88080;
        padding: 5px 12px;
        text-decoration: none;
        transition: all 0.4s ease;
        display: inline-block;
    }

    .btn-more a:hover {
        color: #f88080;
        background-color: #fff;
        transform: translateY(-2px);
    }

    /* Estilos de paginación */
    .pagination-container {
        margin-top: 30px;
        padding: 20px;
        background: #f9f9f9;
        border-radius: 12px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
    }

    .pagination-links {
        display: flex;
        gap: 10px;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
    }

    .pagination-numbers {
        display: flex;
        gap: 8px;
    }

    .pagination-btn {
        display: inline-block;
        padding: 8px 14px;
        background-color: white;
        color: #333;
        border: 1px solid #e0e0e0;
        border-radius: 6px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .pagination-btn:hover:not(.disabled) {
        background-color: #f88080;
        border-color: #f88080;
        color: white;
        transform: translateY(-2px);
    }

    .pagination-btn.active {
        background-color: #fd5d5d;
        border-color: #fd5d5d;
        color: white;
        cursor: default;
    }

    .pagination-btn.disabled {
        background-color: #f0f0f0;
        color: #999;
        cursor: not-allowed;
        border-color: #e0e0e0;
    }

    .pagination-info {
        text-align: center;
        color: #666;
        font-size: 13px;
    }

    .pagination-info strong {
        font-weight: bold;
        color: #fd5d5d;
    }
</style>