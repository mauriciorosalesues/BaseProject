<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
    table{
        height: 300px;
        width: 600px;
    }
</style>
<div class="container">
    <h2>Datos del XML a Json</h2> 
    <tbody>
        <table class="table-striped table-dark">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Cliente</th>
                </tr>
            </thead>
            
            @foreach ($clientes['clientes'] as $cliente)
                <tr>
                    <td> {{ $cliente['id'] }}</td>
                    <td> {{ $cliente['nombre'] }}</td>
                    <td> {{ $cliente['cliente'] }}</td>        
                </tr>
            @endforeach
        </table>
    </tbody>
    

</div>