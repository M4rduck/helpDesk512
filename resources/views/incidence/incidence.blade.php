@extends('adminlte::page')

@section('title', 'HelpDesk | Tracing')

@push('css')
    {!! Html::style('css/incidence/sweetalert2.min.css') !!}
@endpush

@section('content_header')
    <div class="page-header">
        <h2> &nbsp;&nbsp;&nbsp;{{ 'Incidencia '.'# '.$incidence->id }}</h2>
    </div>
@stop

@push('js')
    {!! Html::script('js/incidence/sweetalert2.min.js') !!}
    {!! Html::script('js/incidence/parsley.min.js') !!}
    {!! Html::script('js/tools/loadingOverlay/loadingoverlay.min.js') !!}
    {!! Html::script('vendor/adminlte/vendor/jquery/dist/jquery.slimscroll.min.js') !!}
    {!! Html::script('js/incidence/tracing-index.js') !!}
    {!! Html::script('js/incidence/tracing-store.js') !!}
@endpush

@section('content')

 <div class="container-fluid">
    <div class="row">
        <div class="col-md-9 col-lg-9 col-sm-12">
        <div class="box box-success">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <i class="fa fa-comments-o"></i>

              <h3 class="box-title">Comentarios</h3>
            </div>
            

            {!! Form::hidden('show-chat', route('tracing.show', ['id' => $incidence->id]), ['id' => 'show-chat']) !!}
            <div class="box-body chat" id="chat-box" style="overflow: hidden; width: auto; height: 250px;">
                              
            </div>
            <!-- /.chat -->
            <div class="box-footer">
              {!! Form::open(['route' => 'tracing.store', 'id' => 'store-tracing']) !!}  
              <div class="input-group">
                {!! Form::hidden('tracing[id_incidence]', $incidence->id, ['id' => 'id_incidence']) !!}
                {!! Form::text('tracing[comment]', null, ['placeholder'=>"Type message...", 'class'=>"form-control", 'id' => 'comment']) !!}

                <div class="input-group-btn">
                  {!! Form::button('<i class="fa fa-plus"></i>', ['class'=>"btn btn-success", 'type' => 'submit']) !!}
                </div>
              </div>
              {!! Form::close() !!}
            </div>
          </div>
        </div>

        <div class="col-md-3 col-lg-3 col-sm-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title center-block">Informaci&oacute;n</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title">Titulo de la Solicitud</label>
                            <p id="title">{{ $incidence->solicitude->title }}</p>
                        </div>
                        <div class="form-group">
                            <label for="theme">Nombre de Incidencia</label>
                            <p id="theme">{{ $incidence->theme }}</p>
                        </div>
                        <div class="form-group">
                            <label for="contacto">Contacto</label>
                            <p id="contacto">{{ $incidence->contact->name }}</p>
                        </div>
                        <div class="form-group">
                            <label for="etiquetas">Etiquetas</label>
                            <p id="etiquetas">
                            @foreach(explode(',', $incidence->label) as $item)
                                {{'#'.$item}}&nbsp;
                            @endforeach
                            </p>
                        </div>
                        <div class="form-group">
                            <label for="prioridad">Prioridad</label>
                            <p id="prioridad">{{ $incidence->priority }}</p>
                        </div>
                        <div class="form-group">
                            <label for="state">Estado</label>
                            <p id="state">{{ $incidence->incidencestate->name }}</p>
                        </div>
                        <div class="form-group">
                            <label for="description">Descripci&oacute;n</label>
                            <p id="description">{{ $incidence->description }}</p>
                        </div>
                        @if ($incidence->evidence_route)
                            <div class="form-group">
                                <label for="evidence">Evidencia</label>
                                <p><a id="evidence" href="{{ asset(Storage::url($incidence->id)) }}" download>{{ asset(Storage::url($incidence->id)) }}</a></p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
    </div>
</div>
@stop