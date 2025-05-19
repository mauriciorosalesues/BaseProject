<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    <title>CRUDPosts</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-warning">
        <div class="container-fluid">
            <a class="navbar-brand h1" href={{ route('clientes.index') }}>CRUDPosts</a>
            <div class="justify-end ">
                <div class="col ">
                    <a class="btn btn-sm btn-success" href={{ route('clientes.create') }}>Add Post</a>
                </div>
            </div>
    </nav>
    <style>
    table{
        height: 300px;
        width: 600px;
    }
</style>
<div class="container">
    <h2>Clientes</h2> 
    <tbody>
        <table class="table-striped table-dark">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">telefono</th>
                    <th scope="col">correo</th>
                    <th scope="col">direccion</th>
                    <th scope="col">Cliente</th>
                </tr>
            </thead>
            
            @foreach ($clientes as $cliente)
                <tr>
                    <td> {{ $cliente['id'] }}</td>
                    <td> {{ $cliente['name'] }}</td>
                    <td> {{ $cliente['telefono'] }}</td>
                    <td> {{ $cliente['correo'] }}</td>
                    <td> {{ $cliente['direccion'] }}</td>
                    <td> {{ $cliente['cliente'] }}</td>        
                </tr>
            @endforeach
        </table>
    </tbody>
    

</div>
    
</body>

</html>