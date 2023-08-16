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
                    <div>
                        <a href="{{ route('download.report') }}" class="btn btn-primary btn-sm text-white">
                            <i class="fa-solid fa-download mr-2"></i>
                            Descargar reporte
                        </a>
                    </div>
                </div>

                <div class="card-block table-responsive p-4">
                    <table class="table d-table table-sm table-bordered table-hover">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">
                                    <i class="fa-solid fa-bars mr-1"></i>
                                    Usuario
                                </th>
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
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    Estado
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tasks as $task)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td >
                                        {{ $task->user->name }}
                                    </td>
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
