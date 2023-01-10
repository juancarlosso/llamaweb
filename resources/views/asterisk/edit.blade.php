@extends('layouts.app')

@section('titulo')
    Servidor Asterisk
@endsection

@section('migajas')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Servidor Asterisk</h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="{{route('asterisk.index')}}">Servidor Asterisk</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Editar Srrvidor Asterisk</a></li>
            </ol>
            <a class="btn btn-info d-none d-lg-block m-l-15 text-white" href="{{route('asterisk.index')}}"><i class="fa fa-arrow-left"></i> Regresar</a>
        </div>
    </div>
</div>
@endsection

    @section('contenido')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Editar Servidor Asterisk</h4>
                    <div class="basic-form">
                        <form id="frmDatos" method="post" action="{{route('asterisk.update',$asterisk->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <span class="input-icon">
                                        <label>Nombre del Servidor<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="" name="descripcion" value="{{old('descripcion',$asterisk->descripcion)}}">
                                        <i class="fa fa-hdd-o"></i>    
                                    </span>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>ip Manager<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="" name="ip" value="{{old('ip',$asterisk->ip)}}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Puerto Manager<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="" name="puerto" value="{{old('puerto',$asterisk->puerto)}}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Usuario Manager<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="" name="usuario" value="{{old('usuario',$asterisk->usuario)}}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Password Manager<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="" name="password" value="{{old('password',$asterisk->password)}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Marcar Login<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="" name="marcar_login" value="{{old('marcar_login',$asterisk->marcar_login)}}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Marcar Logout<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="" name="marcar_logout" value="{{old('marcar_logout',$asterisk->marcar_logout)}}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Marcar Pausa<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="" name="marcar_pausa" value="{{old('marcar_pausa',$asterisk->marcar_pausa)}}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Marcar Despausa<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="" name="marcar_despausa" value="{{old('marcar_despausa',$asterisk->marcar_despausa)}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Contexto<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="" name="contexto" value="{{old('contexto',$asterisk->contexto)}}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Contexto Click & Dial<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="" name="contexto_cd" value="{{old('contexto_cd',$asterisk->contexto_cd)}}">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>ip MYSQL<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="" name="ip_mysql" value="{{old('ip_mysql',$asterisk->ip_mysql)}}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Puerto MYSQL<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="" name="puerto_mysql" value="{{old('puerto_mysql',$asterisk->puerto_mysql)}}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Usuario MYSQL<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="" name="usuario_mysql" value="{{old('usuario_mysql',$asterisk->usuario_mysql)}}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Password MYSQL<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="" name="password_mysql" value="{{old('password_mysql',$asterisk->password_mysql)}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>DB MYSQL<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="" name="bd_mysql" value="{{old('bd_mysql',$asterisk->bd_mysql)}}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Tabla MYSQL<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="" name="tabla_mysql" value="{{old('tabla_mysql',$asterisk->tabla_mysql)}}">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Puerto http local<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="" name="puerto_http" value="{{old('puerto_http',$asterisk->puerto_http)}}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Puerto http publico<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="" name="puerto_http_publico" value="{{old('puerto_http_publico',$asterisk->puerto_http_publico)}}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Versión<span class="text-danger">*</span></label>
                                    <select class="select2 form-control form-select" style="width: 100%; height:36px;" id="version" name="version">
                                        <option value='1.4' {{ (old("version",$asterisk->version) == '1.4' ? "selected" : "") }}>1.4</option>
                                        <option value='1.6' {{ (old("version",$asterisk->version) == '1.6' ? "selected" : "") }}>1.6</option>
                                        <option value='1.8' {{ (old("version",$asterisk->version) == '1.8' ? "selected" : "") }}>1.8</option>
                                        </select>
                                </div>
                            </div>
                            {{-- <button type="submit" class="btn btn-primary">Sign in</button> --}}
                            <div class="widget-footer" align="right">
                                <a href="{{route('asterisk.index')}}" class="btn btn-outline-danger"><i class="fas fa-times"></i> Cancelar</a>
                                <button type="submit" class="btn btn-primary mr-3"><i class="fas fa-check"></i> Aceptar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>	
        </div>
    </div>
@endsection
@section('scripts')
<script>
    $(".select2").select2();
</script>
@endsection