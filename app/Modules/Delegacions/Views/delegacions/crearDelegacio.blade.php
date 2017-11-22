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



                {!! Form::open(['url'=>'delegacions/crear', 'method' => 'post']) !!}

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
                                {!! Form::label('Nom de la delegació:') !!}
                                {!! Form::text('nom', null,
                                array('required',
                                'class'=>'form-control')) !!}
                            </div>

                            <div class="form-group col-xs-12 col-md-6">
                                {!! Form::label('Responsable:') !!}
                                {!! Form::text('responsable', null,
                                array('required',
                                'class'=>'form-control')) !!}
                            </div>

                            <div class="form-group col-xs-12 col-md-6">
                                {!! Form::label('Email:') !!}
                                {!! Form::email('email', null,
                                array('required',
                                'class'=>'form-control')) !!}
                            </div>

                            <div class="form-group col-xs-12 col-md-6">
                                {!! Form::label('Telefon:') !!}
                                {!! Form::text('telefon', null,
                                array('required',
                                'class'=>'form-control')) !!}
                            </div>

                            <div class="form-group col-xs-12 col-md-6">
                                {!! Form::label('Fax:') !!}
                                {!! Form::text('fax', null,
                                array('required',
                                'class'=>'form-control')) !!}
                            </div>

                            <div class="form-group col-xs-12 col-md-6">
                                {!! Form::label('Població:') !!}
                                {!! Form::text('poblacio', null,
                                array('required',
                                'class'=>'form-control')) !!}
                            </div>

                            <div class="form-group col-xs-12 col-md-6">
                                {!! Form::label('Codi Postal:') !!}
                                {!! Form::text('CP', null,
                                array('required',
                                'class'=>'form-control')) !!}
                            </div>

                            <div class="form-group col-xs-12 col-md-6">
                                {!! Form::label('Provincia:') !!}
                                {!! Form::text('provincia', null,
                                array('required',
                                'class'=>'form-control')) !!}
                            </div>

                            <div class="form-group col-xs-12 col-md-6">
                                {!! Form::label('Pais:') !!}
                                {!! Form::text('pais', null,
                                array('required',
                                'class'=>'form-control')) !!}
                            </div>


                        </div><!--col-->
                    </div><!--box body-->
                </div><!--box-->

                <div class="btn-group pull-right">
                    {!! Form::submit('Desa', array('class'=>'btn btn-primary flat')) !!}
                    <a href="{{ url('delegacions') }}" class="btn btn-default flat margin-10">Cancel·lar</a>
                </div>

                {!! Former::close() !!}
            </div>
        </div>
    </div>

@endsection
