@extends('layouts.app')

@section('content')
<div class="container">
   
        <h1>Crear Coche</h1>

        <form id="createCocheForm">
            @csrf <!-- Token CSRF -->
            <label for="origen">Origen:</label>
            <input type="text" id="origen" name="origen" required><br>

            <label for="destino">Destino:</label>
            <input type="text" id="destino" name="destino" required><br>

            <label for="marca">Marca:</label>
            <input type="text" id="marca" name="marca" required><br>

            <label for="modelo">Modelo:</label>
            <input type="text" id="modelo" name="modelo" required><br>

            <label for="imagen">Imagen:</label>
            <input type="text" id="imagen" name="imagen" required><br>

            <label for="precio_noche">Precio por noche:</label>
            <input type="number" id="precio_noche" name="precio_noche" required><br>

            <button type="submit">Crear Coche</button>
        </form>

</div>
@endsection
<script>
    document.getElementById('createCocheForm').addEventListener('submit', function(event) {
        const formData = new FormData(event.target);
        const data = Object.fromEntries(formData.entries());
        axios.post('/api/coches', data)
    });
</script>
</body>

</html>