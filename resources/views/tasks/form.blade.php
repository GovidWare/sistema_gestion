

@if ( isset($data) )
    <form method="POST" action="{{ route('tasks.update', $data->id) }}" enctype="multipart/form-data">
        @method('PUT')
@else
    <form method="POST" action="{{ route('tasks.store') }}" enctype="multipart/form-data">
@endif
    @csrf
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="form-group">
                <div class="form-group">
                    <label for="title">
                        Título <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Título" value="{{ $data->title??'' }}" maxlength="50" required>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="start_date">
                    Fecha de inicio <span class="text-danger">*</span>
                </label>
                <input type="date" name="start_date" id="start_date" class="form-control" placeholder="Fecha de inicio" value="{{ $data->start_date??'' }}" required>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="end_date">
                    Fecha de finalización <span class="text-danger">*</span>
                </label>
                <input type="date" name="end_date" id="end_date" class="form-control" placeholder="Fecha de finalización" value="{{ $data->end_date??'' }}" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="description">
                    Descripción <small class="text-secondary">(Opcional)</small>
                </label>
                <textarea name="description" id="description" rows="3" maxlength="200"
                    class="form-control"
                    placeholder="Descripción"
                >{{ $data->description??'' }}</textarea>
            </div>
        </div>
    </div>

    <button class="btn btn-primary btn-sm waves-effect waves-light">
        <i class="fa-solid fa-floppy-disk"></i>
        Guardar
    </button>
</form>
