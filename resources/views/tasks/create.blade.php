@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-sm-6">
        <div class="card">
            <div class="card-header">
                <h5>Tareas</h5>
                <span class="text-mera">Creación</span>
            </div>
            <div class="card-block p-4">
                @include('partials.errors')
                <h4 class="sub-title">Información básica</h4>
                @include('tasks.form')
            </div>
        </div>
    </div>
</div>
@endsection
