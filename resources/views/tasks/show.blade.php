@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-sm-8">
        <div class="card">
            <div class="card-header">
                <h5>
                    <i class="fas fa-tasks mr-2"></i>
                    Tarea
                </h5>
            </div>
            <div class="card-block p-4">

                <div class="row">
                    <div class="col-12 col-sm-6 mb-3">
                        <h6 class="text-mera">Título</h6>
                        {{ $data->title }}
                    </div>
                    <div class="col-12 col-sm-6 mb-3">
                        <h6 class="text-mera">Estado</h6>
                        @switch($data->status)
                            @case('HA')
                                <span class="badge badge-warning mt-2">
                                    {{ Config::get("options.tasks_status.$data->status") }}
                                </span>
                                @break
                            @case('PR')
                                <span class="badge badge-primary mt-2">
                                    {{ Config::get("options.tasks_status.$data->status") }}
                                </span>
                                @break
                            @case('CO')
                                <span class="badge badge-success mt-2">
                                    {{ Config::get("options.tasks_status.$data->status") }}
                                </span>
                                @break
                        @endswitch
                    </div>
                </div>
                <hr>
                <div class="row justify-content-between">
                    <div class="col-12 col-sm-6 mb-3">
                        <h6 class="text-mera">Fecha inicio</h6>
                        {{ $data->start_date }}
                    </div>
                    <div class="col-12 col-sm-6 mb-3">
                        <h6 class="text-mera">Fecha fin</h6>
                        {{ $data->end_date }}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12 mb-3">
                        <h6 class="text-mera">Archivo</h6>
                        @if(isset($data->file))
                            <a href="{{ route('file.download',$data->id) }}" class="btn btn-sm btn-primary">
                                <i class="fa-solid fa-download mr-2"></i>
                                Descargar
                            </a>
                        @else
                            <span class="badge badge-warning">Sin archivo</span>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12 mb-3">
                        <h6 class="text-mera">Descripción</h6>
                        @if( isset($data->description) )
                            {{ $data->description }}
                        @else
                            <span class="badge badge-warning">Sin descripción</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
