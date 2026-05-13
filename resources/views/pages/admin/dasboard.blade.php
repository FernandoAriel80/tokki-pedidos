<x-layout.layout :name="$userAuth['name']">

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
    <section class="users-section">
        <h4 class="title-dasborad">admin panel</h4>
        <div class="users-container">

            <table class="users-table">
                <thead class="users-header-table">
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Autorizacion</th>
                        <th>Rol</th>
                        <th>Fecha de creacion</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody class="users-body-table">
                    @foreach ( $users as $user )
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->is_authorized == true ? "✅": "❌" }}</td>
                        <td>{{ $user->role->name }}</td>
                        <td>{{ $user->created_at->format('d-m-Y') }}</td>
                        <td>
                            <form action="/user-update/{{ $user->id }}" method="post">
                                @csrf
                                @method('put')
                                <button type="submit" onclick="return confirm('¿Seguro que queres dar permisos a este usuario?')">Autorizar</button>
                            </form>
                            <form action="/user-delete/{{ $user->id }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" onclick="return confirm('¿Seguro que queres eliminar este usuario?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($users->hasPages())
            <div class="pagination-container">
                <div class="pagination-links">
                    @if ($users->onFirstPage())
                    <span class="pagination-btn disabled">← Anterior</span>
                    @else
                    <a href="{{ $users->previousPageUrl() }}" class="pagination-btn">← Anterior</a>
                    @endif

                    <div class="pagination-numbers">
                        @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                        @if ($page == $users->currentPage())
                        <span class="pagination-btn active">{{ $page }}</span>
                        @else
                        <a href="{{ $url }}" class="pagination-btn">{{ $page }}</a>
                        @endif
                        @endforeach
                    </div>

                    @if ($users->hasMorePages())
                    <a href="{{ $users->nextPageUrl() }}" class="pagination-btn">Siguiente →</a>
                    @else
                    <span class="pagination-btn disabled">Siguiente →</span>
                    @endif
                </div>

                <div class="pagination-info">
                    Página <strong>{{ $users->currentPage() }}</strong> de <strong>{{ $users->lastPage() }}</strong>
                    | Total: <strong>{{ $users->total() }}</strong> registros
                </div>
            </div>
            @endif
        </div>
    </section>
</x-layout.layout>

<style>
    .title-dasborad {
        margin-bottom: 30px;
    }

    .users-section {
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin-top: 50px;
    }

    .users-container {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        border: 1px solid #f88080;
        min-height: 500px;
        padding: 20px;
        width: 900px;
    }

    .users-header-table {
        background-color: #f88080;
    }

    .users-header-table tr th {
        padding: 10px;
        text-align: center;
        color: #fff;
    }

    .users-body-table tr td {
        padding: 10px;
        text-align: center;
        border-bottom: 1px solid #f88080;
        max-width: 150px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
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