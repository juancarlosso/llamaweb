@extends('layouts.app')

@section('titulo')
    Home
@endsection

@section('migajas')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Home</h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
            </ol>
        </div>
    </div>
</div>
@endsection

@section('contenido')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title" id="1">Bienvenido(a)</h4>
                    <div class="text-center">
                        <h2>Sistema de <strong>LLAMA</strong>das Automáticas</h2>
                        <img src="{{asset('assets/images/llama.png')}}" width='40%'/>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
