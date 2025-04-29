<script>
  // Recibe el JSON del controlador y lo convierte a un objeto de JavaScript
  let vehiculos = JSON.parse('{!! $vehiculosJson !!}');
  // Lo muestra en consola (hay que hacer que se muestre con la tabla editando este archivo)
  console.log(vehiculos);
</script>