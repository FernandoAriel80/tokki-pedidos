<x-layout.layout :name="$user['name']">
    <div class="form-containt">
        <div class="form-order">
            <form action="/create-order" method="POST">
                @csrf
                <x-common.admin.form-input
                    name="title"
                    value=""
                    label="Producto:"
                    type="text"
                    placeholder="Poner el nombre del producto" />

                <x-common.admin.form-input
                    name="customer"
                    value=""
                    label="Cliente:"
                    type="text"
                    placeholder="Poner el nombre del cliente" />
                <x-common.admin.form-input
                    name="price"
                    value=""
                    label="Precio:"
                    type="number"
                    placeholder="Poner el precio del producto" />

                <div class="input-area">
                    <label for="description">Descripción:</label>
                    <textarea name="description" rows="5" cols="50" placeholder="Escribe una descripción detallada...">{{ old('description') }}</textarea>
                    @error('description')
                    <span style="color: #f81a1a;">{{ $message }}</span>
                    @enderror
                </div>
                <x-common.admin.form-input
                    name="delivery_date"
                    value=""
                    label="Fecha de entrega:"
                    type="date"
                    placeholder="Poner la fecha de entrega" />
                <div class="btn-containt">
                    <x-common.btn-submit-cancel text="Cancelar" />
                    <x-common.btn-submit-accept text="Aceptar" />
                </div>

            </form>
        </div>

    </div>
</x-layout.layout>

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

    .input-check {
        width: 100%;
    }

    .input-check-input {
        display: flex;
        width: 200px;
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