@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Prestamo
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Prestamo</span>
                    </div>
                    <div class="card-body">
                        <form id="prestamoForm" method="POST" action="{{ route('prestamos.update', $prestamo->id) }}" role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('prestamo.form')

                        </form>
                        <!-- Modal -->
                        <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title" id="notificationModalLabel">Enviando Notificación</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <p>Se está enviando la notificación. Por favor, espera...</p>
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('prestamoForm');

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            var modal = new bootstrap.Modal(document.getElementById('notificationModal'), {});
            modal.show();

            var formData = new FormData(form);
            var actionUrl = form.getAttribute('action');

            fetch(actionUrl, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                modal.hide();
                if (data.success) {
                    window.location.href = "{{ route('prestamos.index') }}";
                } else {
                    alert('Error: ' + data.error);
                }
            })
            .catch(error => {
                modal.hide();
                console.error('Error:', error);
                alert('Ocurrió un error al procesar la solicitud.');
            });
        });
    });
    </script>
@endsection
