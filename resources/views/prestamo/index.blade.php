@extends('layouts.app')

@section('template_title')
    Prestamo
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Prestamos') }}
                            </span>

                            <form action="{{ route('prestamos.index') }}" method="GET">
                                <div class="form-row align-items-center">
                                    <div class="col my-2 mx-5">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search" placeholder="Buscar prestamos...">
                                            <input type="date" class="form-control ms-1" name="fecha_prestamo" placeholder="Fecha de Préstamo...">
                                            <input type="date" class="form-control ms-1" name="fecha_devolucion" placeholder="Fecha de Devolución...">

                                            <div class="ms-2 input-group-append">
                                                <button type="submit" class="btn btn-primary">Buscar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="float-right">
                                @if(auth()->user()->hasPermission('ver-prestamos'))
                                <a href="{{ route('prestamos.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
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
                                        <th>Estudiante</th>
                                        <th>Libro</th>
                                        <th>Fecha Prestamo</th>
                                        <th>Fecha Devolucion</th>
                                        <th>Cantidad</th>
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($prestamos as $prestamo)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $prestamo->estudiante->nombre }}</td>
                                            <td>{{ $prestamo->libro->titulo }}</td>
                                            <td>{{ $prestamo->fecha_prestamo }}</td>
                                            <td>{{ $prestamo->fecha_devolucion }}</td>
                                            <td>{{ $prestamo->cantidad }}</td>
                                            <td>{{ $prestamo->estado ? 'Activo' : 'Inactivo' }}</td>
                                            <td>
                                                <form action="{{ route('prestamos.inactivar', $prestamo->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    @if(auth()->user()->hasPermission('ver-prestamos'))
                                                    <a class="btn btn-sm btn-primary" href="{{ route('prestamos.show', $prestamo->id) }}"><i class="bi bi-eye"></i></a>
                                                    @endif
                                                    @if(auth()->user()->hasPermission('ver-prestamos'))
                                                    <a class="btn btn-sm btn-success" href="{{ route('prestamos.edit', $prestamo->id) }}"><i class="bi bi-pencil"></i></a>
                                                    @endif
                                                    @if(auth()->user()->hasPermission('ver-prestamos'))
                                                    <button type="button" class="btn btn-success btn-sm entrega-btn" data-prestamo-id="{{ $prestamo->id }}"><i class="bi bi-check-circle"></i></button>
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
                {!! $prestamos->links('pagination::bootstrap-5') !!}
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="entregaModal" tabindex="-1" aria-labelledby="entregaModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="entregaModalLabel">Confirmar Entrega</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <p>¿Está seguro de que desea marcar este préstamo como entregado?</p>
                        <div class="spinner-border text-primary" role="status" id="spinner" style="display: none;">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="confirmEntregaBtn">Confirmar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var entregaModal = new bootstrap.Modal(document.getElementById('entregaModal'), {});
        var confirmEntregaBtn = document.getElementById('confirmEntregaBtn');
        var spinner = document.getElementById('spinner');
        var prestamoId;

        document.querySelectorAll('.entrega-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                prestamoId = this.dataset.prestamoId;
                entregaModal.show();
            });
        });

        confirmEntregaBtn.addEventListener('click', function() {
            spinner.style.display = 'inline-block';

            fetch(`/prestamos/${prestamoId}/inactivar`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                entregaModal.hide();
                spinner.style.display = 'none';

                if (data.success) {

                    location.reload();
                } else {
                    alert('Error: ' + data.error);
                }
            })
            .catch(error => {
                entregaModal.hide();
                spinner.style.display = 'none';
                console.error('Error:', error);
                alert('Ocurrió un error al procesar la solicitud.');
            });
        });
    });
</script>

@endsection
