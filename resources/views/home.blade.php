@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="text-light bg-dark text-center bg-light card-header font-weight-bold">Lista Contactos</div>

                    <h5 class=" bg-dark d-flex flex-row-reverse  bg-light card-header">
                        <a href="{{ route('contactos.create') }}" class="btn btn-md btn btn-outline-success">Agregar
                            Contacto</a>
                    </h5>
                    <div class="bg-dark card-body">


                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert"></button>
                                {{ session()->get('success') }}
                            </div>
                        @endif

                        @if (session()->has('eliminado'))
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert"></button>
                                {{ session()->get('eliminado') }}
                            </div>
                        @endif


                        <table class="table table-hover   table-dark table-borderless">
                            <thead>
                                <th class="col-4">Nombre</th>
                                <th class="col-5">Número</th>
                                <th class="col-3"></th>

                            </thead>
                            <tbody>
                                @forelse ($contactos as $contacto)
                                    <tr>
                                        <td>{{ $contacto->nombre }}</td>
                                        <td>{{ $contacto->numero }}</td>
                                        <td class="float">
                                            <a href="{{ route('contactos.edit', $contacto->id) }}"
                                                class="btn btn-sm btn-outline-success"><i
                                                    class="bi bi-pen">editar</i></a>
                                            <a href="{{ route('contactos.show', $contacto->id) }}"
                                                class="btn btn-sm btn-outline-danger"><i
                                                    class="bi bi-trash">eliminar</i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>Sin contactos</td>
                                    </tr>
                                @endforelse



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
