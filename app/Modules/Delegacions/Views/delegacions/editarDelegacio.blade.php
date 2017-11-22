@extends('app')

@section('content')

    <div class="page-content">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                @if (Session::has('flash_message'))
                    <div style="background-color: #ff0000; text-align: center;">
                        {!! Session::get('flash_message') !!}
                    </div>
                @endif


                {!! Form::open(['url'=>'delegacions/editar/'. $id, 'method' => 'post']) !!}

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Dades generals</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-xs-12">

                            <div class="form-group col-xs-12">
                                {!! Form::label('nom:') !!}
                                @if(isset($del->nom))
                                    {!! Form::text('nom', $del->nom,
                                    array('required',
                                    'class'=>'form-control')) !!}
                                @else
                                    {!! Form::text('nom', null,
                                    array('required',
                                    'class'=>'form-control')) !!}
                                @endif
                            </div>

                            <div class="form-group col-xs-12 col-md-6">
                                {!! Form::label('responsable:') !!}
                                @if(isset($del->responsable))
                                    {!! Form::text('responsable', $del->responsable,
                                    array('required',
                                    'class'=>'form-control')) !!}
                                @else
                                    {!! Form::text('responsable', null,
                                    array('required',
                                    'class'=>'form-control')) !!}
                                @endif
                            </div>

                            <div class="form-group col-xs-12 col-md-6">
                                {!! Form::label('email:') !!}
                                @if(isset($del->email))
                                    {!! Form::email('email', $del->email,
                                    array('required',
                                    'class'=>'form-control')) !!}
                                @else
                                    {!! Form::email('email', null,
                                    array('required',
                                    'class'=>'form-control')) !!}
                                @endif
                            </div>

                            <div class="form-group col-xs-12 col-md-6">
                                {!! Form::label('telefon:') !!}
                                @if(isset($del->telefon))
                                    {!! Form::text('telefon', $del->telefon,
                                    array('required',
                                    'class'=>'form-control')) !!}
                                @else
                                    {!! Form::text('telefon', null,
                                    array('required',
                                    'class'=>'form-control')) !!}
                                @endif
                            </div>

                            <div class="form-group col-xs-12 col-md-6">
                                {!! Form::label('fax:') !!}
                                @if(isset($del->fax))
                                    {!! Form::text('fax', $del->fax,
                                    array('required',
                                    'class'=>'form-control')) !!}
                                @else
                                    {!! Form::text('fax', null,
                                    array('required',
                                    'class'=>'form-control')) !!}
                                @endif
                            </div>

                            <div class="form-group col-xs-12 col-md-6">
                                {!! Form::label('poblacio:') !!}
                                @if(isset($del->poblacio))
                                    {!! Form::text('poblacio', $del->poblacio,
                                    array('required',
                                    'class'=>'form-control')) !!}
                                @else
                                    {!! Form::text('poblacio', null,
                                    array('required',
                                    'class'=>'form-control')) !!}
                                @endif
                            </div>

                            <div class="form-group col-xs-12 col-md-6">
                                {!! Form::label('CP:') !!}
                                @if(isset($del->CP))
                                    {!! Form::text('CP', $del->CP,
                                    array('required',
                                    'class'=>'form-control')) !!}
                                @else
                                    {!! Form::text('CP', null,
                                    array('required',
                                    'class'=>'form-control')) !!}
                                @endif
                            </div>

                            <div class="form-group col-xs-12 col-md-6">
                                {!! Form::label('provincia:') !!}
                                @if(isset($del->provincia))
                                    {!! Form::text('provincia', $del->provincia,
                                    array('required',
                                    'class'=>'form-control')) !!}
                                @else
                                    {!! Form::text('provincia', null,
                                    array('required',
                                    'class'=>'form-control')) !!}
                                @endif
                            </div>

                            <div class="form-group col-xs-12 col-md-6">
                                {!! Form::label('pais:') !!}
                                @if(isset($del->pais))
                                    {!! Form::text('pais', $del->pais,
                                    array('required',
                                    'class'=>'form-control')) !!}
                                @else
                                    {!! Form::text('pais', null,
                                    array('required',
                                    'class'=>'form-control')) !!}
                                @endif
                            </div>


                        </div><!--col-->
                    </div><!--box body-->
                </div><!--box-->

                <div class="btn-group pull-right">
                    {!! Form::submit('Desa', array('class'=>'btn btn-primary flat')) !!}
                    <a href="{{ url('delegacions') }}" class="btn btn-default flat margin-10">Cancel·lar</a>
                </div>
                {!! Form::close() !!}
                        <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content -->

@stop
