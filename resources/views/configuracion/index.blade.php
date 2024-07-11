@extends('layouts.app')

@section('template_title')
    Configuracion
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Configuracion') }}
                            </span>

                             <div class="float-right">
                                @if(auth()->user()->hasPermission('crear-configuraciones'))
                                <a href="{{ route('configuraciones.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo') }}
                                </a>
                                @endif
                              </div>
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
										<th>Telefono</th>
										<th>Correo</th>
										<th>Direccion</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($configuracions as $configuracion)
                                        <tr>
                                            <td>{{ ++$i }}</td>

											<td>{{ $configuracion->nombre }}</td>
											<td>{{ $configuracion->telefono }}</td>
											<td>{{ $configuracion->correo }}</td>
											<td>{{ $configuracion->direccion }}</td>

                                            <td>
                                                <form action="{{ route('configuraciones.destroy',$configuracion->id) }}" method="POST">
                                                    @if(auth()->user()->hasPermission('ver-configuraciones'))
                                                    <a class="btn btn-sm btn-primary " href="{{ route('configuraciones.show',$configuracion->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    @endif
                                                    @if(auth()->user()->hasPermission('editar-configuraciones'))
                                                    <a class="btn btn-sm btn-success" href="{{ route('configuraciones.edit',$configuracion->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @endif
                                                    @csrf
                                                    @method('DELETE')
                                                    @if(auth()->user()->hasPermission('eliminar-configuraciones'))
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                @endif
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $configuracions->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection
