@extends('plantilla.page')
@section('title', 'Paises')

@push('css')
    <link rel="stylesheet" href="//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.css">
    <style>                        
    </style>
@endpush

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading"><span class="glyphicon glyphicon-globe"></span> Paises</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">                        
                    <table id="tblCountries" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Codigo ISO</th>
                                <th>Fecha creado</th>
                                <th>Fecha editado</th>
                                <th>Fecha eliminado</th>
                            </tr>
                        </thead>    
                    </table>                        
                </div>                
            </div>                
        </div>            
    </div>    
@stop
@push('js')
    <script src="//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.js"></script>
    <script type="text/javascript">
        let tblCountries;
        let tblCountriesData={!!$data??"[]"!!};
        $(document).ready(function() {
            tblCountries=$('#tblCountries').DataTable({
            "data": tblCountriesData,
            "scrollX": true,
            "searching": true,
            "order": [ 0, "desc"],
            columns: [
                { "data": "id" },
                { "data": "name" },
                { "data": "code" },
                { "data": "created_at" },
                { "data": "updated_at" },
                { "data": "deleted_at" },
            ]
            });            
        });
    </script>
@endpush