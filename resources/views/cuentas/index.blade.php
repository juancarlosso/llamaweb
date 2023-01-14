@extends('layouts.app')

@section('titulo')
    Cuentas
@endsection

@section('migajas')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Cuentas</h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Cuentas</a></li>
            </ol>
            <a class="btn btn-info d-none d-lg-block m-l-15 text-white" href="{{route('cuentas.create')}}"><i class="fa fa-plus"></i> Agregar</a>
        </div>
    </div>
</div>
@endsection

    @section('contenido')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Lista de Cuentas</h4>
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th><strong>Descripción</strong></th>
                                    <th><strong>Tabla teléfonos</strong></th>
                                    <th><strong>troncal</strong></th>
                                    <th><strong>%</strong></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cuentas as $cuenta)
                                    <tr>
                                        <td><div class="d-flex align-items-center"><span class="w-space-no">{{$cuenta->descripcion}}</span></div></td>
                                        <td>{{$cuenta->tabla_telefonos}}	</td>
                                        <td>{{$cuenta->troncal}}</td>
                                        {{-- echo "<span class='badge badge-purple'>{$porcentaje}%</span>" --}}
                                        <td>{{$cuenta->porcentaje}}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{route('cuentas.edit',$cuenta->id)}}" class="btn btn-info shadow btn-xs sharp mr-1" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                                &nbsp;
                                                <a href="{{route('cuentas.importar',$cuenta->id)}}" class="btn btn-warning shadow btn-xs sharp mr-1" title="Importar teléfonos"><i class="fas fa-upload"></i></a>
                                                &nbsp;
                                                <a href="{{route('cuentas.edit',$cuenta->id)}}" class="btn btn-primary shadow btn-xs sharp mr-1" title="Estadísticas y reportes"><i class='fas fa-chart-pie'></i></a>
                                                &nbsp;
                                                <a href="{{route('cuentas.edit',$cuenta->id)}}" class="btn btn-success shadow btn-xs sharp mr-1" title="Nueva barrida"><i class="fas fa-recycle"></i></a>
                                                &nbsp;
                                                <a href="javascript:borrado({{$cuenta->id}})" class="btn btn-danger shadow btn-xs sharp" title="Eliminar"><i class="fas fa-trash"></i></a>
                                                <form action="{{route('cuentas.destroy', $cuenta->id)}}" method="post" name="formBorrar{{$cuenta->id}}" id="formBorrar{{$cuenta->id}}">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$cuentas->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
function borrado(id){
    console.log(id);
   Swal.fire({
       title: '¿Eliminar Cuenta?',
       text: "No se podrá deshacer esta operación!",
       type: 'warning',
       showCancelButton: true,
       confirmButtonColor: '#d33',
       cancelButtonColor: '#3085d6',
       confirmButtonText: 'Si, Eliminar!',
       cancelButtonText: 'Cerrar'
   }).then((result) => {
       if (result.value) {
           var formulario = "#formBorrar" + id;
           $(formulario).submit();
       }
   })
}
</script>
@endsection
