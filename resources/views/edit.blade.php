@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-light bg-dark">
                    <div class="h2 card-header">{{ $contacto->nombre }}</div>

                    <h5 class="card-header">
                        <a href="{{ route('contactos.index') }}" class="btn btn-sm btn btn-outline-primary">
                            <i class="bi bi-arrow-left">Volver</i></a>
                    </h5>
                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert"></button>
                                {{ session()->get('success') }}
                            </div>
                        @endif


                        <form method="POST" action="{{ route('contactos.update', $contacto->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="nombre" class="col-form-label text-md-right">Nombre del contacto</label>

                                <input id="nombre" type="title" class="form-control @error('nombre') is-invalid @enderror"
                                    name="nombre" value="{{ $contacto->nombre }}" autocomplete="off" autofocus>

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="numero" class="col-form-label text-md-right">Numero</label>
                                <input name="numero" type="number" id="numero"
                                    class="form-control @error('numero') is-invalid @enderror" autocomplete="description"
                                    value="{{ $contacto->numero }}" autocomplete="off">



                                @error('numero')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-success">
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
