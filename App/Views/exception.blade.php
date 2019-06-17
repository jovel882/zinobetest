@extends('plantilla.page')
@section('title', 'Error - '.$exception->getCode())

@section('content')
    <div class="panel panel-danger">
        <div class="panel-heading"><span class="glyphicon glyphicon-exclamation-sign"></span> Error {{$exception->getCode()}}</div>
            <div class="panel-body">
                <div class="panel panel-warning">
                    <div class="panel-heading"><span class="glyphicon glyphicon-paperclip"></span> General</div>
                    <div class="panel-body">
                        <h4><strong>Archivo:</strong> {{$exception->getFile()}} <strong>Linea:</strong> {{$exception->getLine()}}</h4>
                    </div> 
                </div>                                                                            
                <div class="panel panel-warning">
                    <div class="panel-heading"><span class="glyphicon glyphicon-paperclip"></span> Mensaje</div>
                    <div class="panel-body">
                        {{$exception->getMessage()}}
                    </div> 
                </div>                                                                            
                <div class="panel panel-warning">
                    <div class="panel-heading"><span class="glyphicon glyphicon-paperclip"></span> Detalle</div>
                    <div class="panel-body">
                        {{$exception->getTraceAsString()}}
                    </div> 
                </div>                                                                            
            </div>            
        </div>    
    </div>    
@stop