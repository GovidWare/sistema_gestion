

@if ( isset($data) )
    <form method="POST" action="{{ route('tasks.update', $data->id) }}" enctype="multipart/form-data">
        @method('PUT')
@else
    <form method="POST" action="{{ route('tasks.store') }}" enctype="multipart/form-data">
@endif
    @csrf
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="form-group">
                <div class="form-group">
                    <label for="title">
                        Título <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Título" value="{{ $data->title??'' }}" maxlength="50" required>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="status">Estado <span class="text-danger">*</span></label>
                <select name="status" id="status" class="form-control" required>
                    <option value="">Seleccione...</option>
                    @foreach ( Config::get('options.tasks_status') as $key => $value)
                        <option value="{{ $key }}" {{ (isset($data->status) && $data->status == $key)? 'selected':'' }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
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
                <label for="file">
                    Archivo <small class="text-secondary">(Opcional)</small>
                </label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="file" name="file" onchange="updateFileName()">
                    <label class="custom-file-label" for="file" id="fileLabel">
                        {{ $data->file?? 'Seleccione un archivo'}}
                    </label>
                </div>
            </div>
            @if(isset($data->file))
                <a href="{{ route('file.download',$data->id) }}" class="btn btn-sm btn-primary mb-2">
                    <i class="fa-solid fa-download mr-2"></i>
                    Descargar
                </a>
            @endif
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

@section('scripts')
<script>
    function updateFileName() {
        const fileInput = document.getElementById('file');
        const fileLabel = document.getElementById('fileLabel');

        if (fileInput.files.length > 0) {
            fileLabel.textContent = fileInput.files[0].name;
        } else {
            fileLabel.textContent = 'Seleccione un archivo';
        }
    }
    </script>

@endsection
