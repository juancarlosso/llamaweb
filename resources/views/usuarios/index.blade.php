@extends('layouts.app')

@section('titulo')
    Usuarios
@endsection

@section('migajas')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Usuarios</h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Usuarios</a></li>
            </ol>
            <a class="btn btn-info d-none d-lg-block m-l-15 text-white" href="{{route('usuarios.create')}}"><i class="fa fa-plus"></i> Agregar</a>
        </div>
    </div>
</div>
@endsection

    @section('contenido')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Lista de Usuarios</h4>
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th><strong>Nombre</strong></th>
                                    <th><strong>E-mail</strong></th>
                                    <th><strong>Estado</strong></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usuarios as $usuario)
                                    <tr>
                                        <td><div class="d-flex align-items-center"><span class="w-space-no">{{$usuario->name}}</span></div></td>
                                        <td>{{$usuario->email}}	</td>
                                        <td>
                                            @if($usuario->status==1)
                                                <div class="d-flex align-items-center"><i class="fa fa-circle text-success mr-1"></i>&nbsp;Activo</div></td>
                                            @else
                                                <div class="d-flex align-items-center"><i class="fa fa-circle text-danger mr-1"></i>&nbsp;inactivo</div></td>
                                            @endif
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{route('usuarios.edit',$usuario->id)}}" class="btn btn-info shadow btn-xs sharp mr-1" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                                &nbsp;
                                                <a href="javascript:borrado({{$usuario->id}})" class="btn btn-danger shadow btn-xs sharp" title="Eliminar"><i class="fas fa-trash"></i></a>
                                                <form action="{{route('usuarios.destroy', $usuario->id)}}" method="post" name="formBorrar{{$usuario->id}}" id="formBorrar{{$usuario->id}}">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
       title: '¿Eliminar Usuario?',
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
