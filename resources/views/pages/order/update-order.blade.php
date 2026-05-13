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

    <div class="form-containt">
        <div class="form-order">
            <form action="/save-order/{{ $order->id }}" method="POST" onsubmit="disableButton(this)">
                @csrf
                @method('PUT')
                <x-common.auth.form-input
                    name="title"
                    :value="$order->product_title"
                    label="Producto:"
                    type="text"
                    placeholder="Poner el nombre del producto" />

                <x-common.auth.form-input
                    name="customer"
                    :value="$order->customer_name"
                    label="Cliente:"
                    type="text"
                    placeholder="Poner el nombre del cliente" />
                <x-common.auth.form-input
                    name="price"
                    :value="$order->price"
                    label="Precio:"
                    type="number"
                    placeholder="Poner el precio del producto" />

                <div class="input-area">
                    <label for="description">Descripción:</label>
                    <textarea name="description" rows="5" cols="50" placeholder="Escribe una descripción detallada...">{{ $order->description }}</textarea>
                    @error('description')
                    <span style="color: #f81a1a;">{{ $message }}</span>
                    @enderror
                </div>
                <x-common.auth.form-input
                    name="delivery_date"
                    :value="$order->delivery_date instanceof \Carbon\Carbon ? $order->delivery_date->format('Y-m-d') : $order->delivery_date"
                    label="Fecha de entrega:"
                    type="date"
                    placeholder="Poner la fecha de entrega" />
                <div class="input-check-input">
                    <label for="is_finished">
                        ¿Está entregado?
                    </label>
                    <input
                        class="is_finished"
                        type="checkbox"
                        name="is_finished"
                        id="is_finished"
                        value="1"
                        {{ $order->is_finished ? 'checked' : '' }}>
                </div>
                @if ($order->is_finished)
                <x-common.auth.form-input
                    name="finished_date"
                    :value="$order->finished_date instanceof \Carbon\Carbon ? $order->finished_date->format('Y-m-d') : $order->finished_date"
                    label="Fecha de pedido entregado:"
                    type="date"
                    placeholder="Poner la fecha que se entrego" />

                @endif
                <div class="btn-containt">
                    <x-common.btn-submit-cancel text="Cancelar" url="{{ url()->previous() }}" />
                    <x-common.btn-submit-accept text="Aceptar" />
                </div>

            </form>
        </div>

    </div>
</x-layout.layout>

<script>
    function disableButton(form) {
        const btn = form.querySelector('button[type="submit"]');
        btn.disabled = true;
        btn.textContent = 'Guardando...';
        return true; // Permite que el formulario se envíe
    }
</script>

<style>
    :root {
        --primary-color: #fd5d5d;
        --hover-primary-color: #f88080;
    }

    .form-containt {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 100%;
    }

    .form-order {
        padding: 20px;
        width: 500px;
        margin: 50px;
        border-radius: 20px;
        box-shadow: 1px 5px 5px rgba(54, 54, 54, 0.5);
        text-align: center;
    }

    .form-order form {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 20px;
        padding: 20px;
        text-align: left;
    }

    .form-order form input {
        width: 400px;
    }

    .input-check-input {
        display: flex;
        align-items: center;
        text-align: left;
        gap: 10px;
        padding: 10px 20px;
        margin: 10px 0;
    }

    .input-check-input label {
        margin: 0;
        cursor: pointer;
        font-weight: normal;
    }

    .input-check-input .is_finished {
        width: 18px;
        height: 18px;
        cursor: pointer;
        margin: 0;
    }

    .input-check-input .is_finished:hover {
        transform: scale(1.05);
    }

    .input-area,
    .input-check-input {
        padding: 0 20px;
    }

    .btn-containt {
        display: flex;
        width: 100%;
        justify-content: space-around;
        gap: 30px;
    }

    .input-area textarea:hover {
        border: 1px solid var(--hover-primary-color);
        outline: none;
    }

    .input-area textarea:focus {
        border: 2px solid var(--hover-primary-color);
        outline: none;
    }
</style>