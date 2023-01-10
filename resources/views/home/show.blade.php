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
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
                {{-- <li class="breadcrumb-item active">Fix Header Sidebar</li> --}}
            </ol>
            {{-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i class="fa fa-plus-circle"></i> Create New</button> --}}
        </div>
    </div>
</div>
@endsection

@section('contenido')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title" id="1">Home</h4>
                    <div class="text-center">
                        <img src="{{asset('assets/images/imac.png')}}" width='50%'/>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
