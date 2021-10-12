@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-dark text-light">
                    <div class="h2 card-header">{{ $contacto->nombre }}</div>


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


                        <form method="POST" action="{{ route('contactos.destroy', $contacto->id) }}">
                            @csrf
                            @method('DELETE')

                            <div class=".from-group row mb-0">
                                <div class="col-md-12">
                                    <h4>Estas seguro que quieres eliminarlo?{{ $contacto->delete }}</h4>
                                </div>

                            </div>



                            <div class="form-group row mb-0">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-danger">
                                        Eliminar
                                    </button>
                                    <a href="{{ route('contactos.index') }}" class="btn btn-info">No</a>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
