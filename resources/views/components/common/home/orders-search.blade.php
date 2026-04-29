    @props(['search'])

    <div class="search-container">
        <form method="GET" action="{{ route('home.search') }}" class="search-form">
            <input
                type="text"
                name="search"
                placeholder="Buscar por producto, cliente o precio..."
                value="{{$search}}"
                class="search-input">
            <button type="submit" class="search-btn">Buscar</button>
            @if($search)
            <a href="{{ route('home') }}" class="clear-btn">✖</a>
            @endif
        </form>
    </div>


    <style>
        .search-container {
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
        }

        .search-form {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .search-input {
            padding: 10px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            width: 300px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #fd5d5d;
            box-shadow: 0 0 0 3px rgba(253, 93, 93, 0.1);
        }

        .search-btn {
            background-color: #fd5d5d;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .search-btn:hover {
            background-color: #f88080;
            transform: translateY(-2px);
        }

        .clear-btn {
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            padding: 7px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .clear-btn:hover {
            background-color: #5a6268;
            transform: translateY(-2px);
        }
    </style>