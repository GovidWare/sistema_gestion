@if(count($registers) && $registers->total() > Config::get('options.paginate.primary') )
    <li class="list-group-item">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                {{ $registers->appends(Request::except(['_token','_method']))->onEachSide(1)->links() }}
            </div>
            <div class="col-md-6 col-sm-12 text-center">
                {{ __('Mostrando') }} {{ $registers->firstItem()??0 }}
                {{ __('a')}} {{ $registers->lastItem()??0 }} {{ __('registros') }}
                {{ __('de')}} {{ $registers->total()}} {{ __('resultados')}}
            </div>
        </div>
    </li>
@endif
