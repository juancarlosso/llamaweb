@extends('layouts.app')

@section('titulo')
    Clientes
@endsection

@section('migajas')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Clientes</h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Clientes</a></li>
            </ol>
            <a class="btn btn-info d-none d-lg-block m-l-15 text-white" href="{{route('clientes.create')}}"><i class="fa fa-plus"></i> Agregar</a>
        </div>
    </div>
</div>
@endsection

    @section('contenido')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Lista de Clientes</h4>
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th><strong>Nombre</strong></th>
                                    <th><strong>Ejecutivo</strong></th>
                                    <th><strong>Teléfono</strong></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clientes as $cliente)
                                    <tr>
                                        <td><div class="d-flex align-items-center"><span class="w-space-no">{{$cliente->nombre}}</span></div></td>
                                        <td>{{$cliente->ejecutivo}}	</td>
                                        <td>{{$cliente->telefono}}	</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{route('clientes.edit',$cliente->id)}}" class="btn btn-info shadow btn-xs sharp mr-1" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                                &nbsp;
                                                <a href="javascript:borrado({{$cliente->id}})" class="btn btn-danger shadow btn-xs sharp" title="Eliminar"><i class="fas fa-trash"></i></a>
                                                <form action="{{route('clientes.destroy', $cliente->id)}}" method="post" name="formBorrar{{$cliente->id}}" id="formBorrar{{$cliente->id}}">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$clientes->links()}}
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
       title: '¿Eliminar Cliente?',
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
