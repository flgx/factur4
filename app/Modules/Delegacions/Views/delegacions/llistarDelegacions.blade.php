@extends('app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-2">
                            <h4>Delegacions</h4>
                        </div>
                        <div class="col-md-10">
                            <div class="pull-right">
                                <a class="btn btn-primary" href="{{url('/delegacions/crear')}}">Crear delegació</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                      {!! $DataTable->table(['class' => 'table table-bordered table-hover']) !!}
                </div>
            </div>

          @include('partials.modalEsborrat')

        </div>
    </div>
@endsection

@section('scripts')
    {!! $DataTable->scripts() !!}
@endsection
