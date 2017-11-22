@extends('app')

@section('content')
<div class="page-content">
    <div class="row">
        <div class="col-xs-12">

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

              <dl class="col-md-12">
                  <dt>Nom</dt>
                  <dd>{{$delegacions->nom}}</dd>
              </dl>
              <dl class="col-md-6">
                  <dt>Responsable</dt>
                  <dd>{{$delegacions->responsable}}</dd>
              </dl>
              <dl class="col-md-6">
                  <dt>Email</dt>
                  <dd>{{$delegacions->email}}</dd>
              </dl>
              <dl class="col-md-6">
                  <dt>Telèfon</dt>
                  <dd>{{$delegacions->telefon}}</dd>
              </dl>
              <dl class="col-md-6">
                  <dt>Fax</dt>
                  <dd>{{$delegacions->fax}}</dd>
              </dl>
              <dl class="col-md-6">
                  <dt>Poblacio</dt>
                  <dd>{{$delegacions->poblacio}}</dd>
              </dl>
              <dl class="col-md-6">
                  <dt>CP</dt>
                  <dd>{{$delegacions->CP}}</dd>
              </dl>
              <dl class="col-md-6">
                  <dt>Provincia</dt>
                  <dd>{{$delegacions->provincia}}</dd>
              </dl>
              <dl class="col-md-6">
                  <dt>Pais</dt>
                  <dd>{{$delegacions->pais}}</dd>
              </dl>


            </div><!--col-->
          </div><!--box body-->
        </div><!--box-->



          </div>
      </div>
  </div>

@stop
