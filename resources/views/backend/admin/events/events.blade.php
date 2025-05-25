@extends('backend.menus.superior')

@section('content-admin-css')
<link href="{{ asset('css/adminlte.min.css') }}" type="text/css" rel="stylesheet" />
<link href="{{ asset('css/dataTables.bootstrap4.css') }}" type="text/css" rel="stylesheet" />
<link href="{{ asset('css/toastr.min.css') }}" type="text/css" rel="stylesheet" />
<link href="{{ asset('css/responsive.bootstrap4.min.css') }}" type="text/css" rel="stylesheet" />
<link href="{{ asset('css/buttons.bootstrap4.min.css') }}" type="text/css" rel="stylesheet" />
<link href="{{ asset('css/estiloToggle.css') }}" type="text/css" rel="stylesheet" />
<link href="{{ asset('css/buttons_estilo.css') }}" rel="stylesheet">
@stop

<style>
    table {
        /*Ajustar tablas*/
        table-layout: fixed;
    }
</style>

<div id="divcontenedor" style="display: none">
    <h1>Agregar implementacion aca</h1>
   

</div>


@extends('backend.menus.footerjs')
@section('archivos-js')

<script src="{{ asset('js/jquery.dataTables.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/dataTables.bootstrap4.js') }}" type="text/javascript"></script>

<script src="{{ asset('js/toastr.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/axios.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('js/alertaPersonalizada.js') }}"></script>
<script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/jszip.min.js') }}"></script>
<script src="{{ asset('js/buttons.html5.min.js') }}"></script>


<script type="text/javascript">
    $(document).ready(function() {
      
        document.getElementById("divcontenedor").style.display = "block";
    });
</script>




@stop