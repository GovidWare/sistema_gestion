@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>
                        Tareas
                        <span class="badge bg-primary text-white">{{ $tasks->total() }}</span>
                    </h4>
                    <span>(Por hacer y completadas)</span>

                    <div>

                        <a href="{{ route('tasks.create') }}" class="btn btn-primary btn-sm text-white">
                            <i class="fa-solid fa-plus text-white" ></i>
                            Crear
                        </a>
                    </div>
                </div>

                <div class="card-block table-responsive p-4">
                    <table class="table d-table table-sm table-bordered table-hover">
                        <thead class="bg-mera">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">
                                    <i class="fa-solid fa-bars mr-1"></i>
                                    Título
                                </th>
                                <th class="text-center">
                                    <i class="fa-solid fa-sticky-note mr-1"></i>
                                    Descripción
                                </th>
                                <th class="text-center">
                                    <i class="fa-solid fa-calendar-days mr-1"></i>
                                    Fecha inicio
                                </th>
                                <th class="text-center">
                                    <i class="fa-solid fa-calendar-days mr-1"></i>
                                    Fecha fin
                                </th>
                                <th class="text-center">
                                    <i class="fa-solid fa-calendar-days mr-1"></i>
                                    Tiempo
                                </th>
                                <th class="text-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    Estado
                                </th>
                                <th style="max-width: 130px; width: 130px" class="text-center">
                                    <i class="fas fa-tools mr-1"></i>
                                    Opciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tasks as $task)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>
                                        @if( strlen($task->title) > 15 )
                                            <span title="{{ $task->title }}">
                                                {{ mb_substr( $task->title,0,15,'UTF-8' ) }}...
                                            </span>
                                        @else
                                            {{ $task->title }}
                                        @endif
                                    </td>
                                    <td>
                                        @if( isset($task->description) )
                                            @if( strlen($task->description) > 20 )
                                                <span title="{{ $task->description }}">
                                                    {{ mb_substr( $task->description,0,20,'UTF-8' ) }}...
                                                </span>
                                            @else
                                                {{ $task->description }}
                                            @endif
                                        @else
                                            <span class="badge badge-warning">Sin observación</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $task->start_date }}</td>
                                    <td class="text-center">{{ $task->end_date }}</td>
                                    <td class="text-center">
                                        @if ( $task->status == 'HA')
                                            <span class="text-small">
                                                Empieza: {{ $task->time_remaining }}
                                            </span>
                                        @else
                                            Termino: {{ $task->time_completion }}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @switch($task->status)
                                            @case('HA')
                                                <span class="badge badge-warning mt-2">
                                                    {{ Config::get("options.tasks_status.$task->status") }}
                                                </span>
                                                @break
                                            @case('PR')
                                                <span class="badge badge-primary mt-2">
                                                    {{ Config::get("options.tasks_status.$task->status") }}
                                                </span>
                                                @break
                                            @case('CO')
                                                <span class="badge badge-success mt-2">
                                                    {{ Config::get("options.tasks_status.$task->status") }}
                                                </span>
                                                @break
                                        @endswitch
                                    </td>

                                    <td class="p-1">
                                        <div class="btn-group d-flex justify-content-center align-items-center">
                                            <button type="button" class="btn btn-outline-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-solid fa-bars"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('tasks.show', $task->id) }}">
                                                        <i class="fa-sharp fa-regular fa-eye mr-4 text-success"></i>
                                                        Ver
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('tasks.edit', $task->id) }}">
                                                        <i class="fa-solid fa-pen-to-square mr-4 text-info"></i>
                                                        Editar
                                                    </a>
                                                </li>
                                                <li>
                                                    <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item btn btn-destroy">
                                                            <i class="fa-solid fa-trash-can mr-4 text-danger"></i>
                                                            Eliminar
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">Sin registros</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <ul class="list-group list-group-flush border-top">
                    @include('partials.pagination', [ 'registers' => $tasks ])
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $('.btn-destroy').on('click', function() {
        // Swal.fire({
        //     title: '¿Eliminar registro?',
        //     icon: 'question',
        //     showCancelButton: true,
        //     confirmButtonText: 'Confirmar',
        //     cancelButtonText: 'Cancelar',
        // }).then((result) => {
        //     if (result.isConfirmed) {
        //         $(this).parent().trigger( "submit" )
        //     }
        // })
    })
</script>
@endsection
