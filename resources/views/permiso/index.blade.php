@extends('layouts.app')

@section('template_title')
    Permiso
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Permiso') }}
                            </span>

                            {{-- <div class="float-right">
                                @if(auth()->user()->hasPermission('crear-permisos'))
                                    <a href="{{ route('permisos.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                      {{ __('Crear Nuevo') }}
                                    </a>
                                @endif
                              </div> --}}
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Nombre</th>
                                        {{-- <th>Tipo</th> --}}
                                        {{-- <th></th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permisos as $permiso)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $permiso->nombre }}</td>
                                            {{-- <td>{{ $permiso->tipo }}</td> --}}
                                            {{-- <td>
                                                <form action="{{ route('permisos.destroy', $permiso->id) }}" method="POST">
                                                    @if(auth()->user()->hasPermission('ver-permisos'))
                                                        <a class="btn btn-sm btn-primary" href="{{ route('permisos.show', $permiso->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    @endif
                                                    @if(auth()->user()->hasPermission('editar-permisos'))
                                                        <a class="btn btn-sm btn-success" href="{{ route('permisos.edit', $permiso->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @endif
                                                    @csrf
                                                    @method('DELETE')
                                                    @if(auth()->user()->hasPermission('eliminar-permisos'))
                                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                    @endif
                                                </form>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $permisos->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection
