@extends('plantilla.page')
@section('title', 'Usuarios')

@push('css')
    <link rel="stylesheet" href="//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.css">
    <style>
        #overlay {
        position: fixed;
        display: none;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0,0,0,0.5);
        z-index: 100;
        cursor: pointer;
        }

        #text{
        position: absolute;
        top: 50%;
        left: 50%;
        font-size: 50px;
        color: white;
        transform: translate(-50%,-50%);
        -ms-transform: translate(-50%,-50%);
        }
        .glyphicon.normal-right-spinner {
            -webkit-animation: glyphicon-spin-r 2s infinite linear;
            animation: glyphicon-spin-r 2s infinite linear;
        }

        @-webkit-keyframes glyphicon-spin-r {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(359deg);
                transform: rotate(359deg);
            }
        }

        @keyframes glyphicon-spin-r {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(359deg);
                transform: rotate(359deg);
            }
        }
        #divErrors{
            margin: 2em 0;
            display: none;
        }                
    </style>
@endpush

@section('content')
    <form class="form-horizontal" name="frmUser" id="frmUser" action="" method="POST">                    
        <div class="panel panel-default">
            <div class="panel-heading"><span class="glyphicon glyphicon-user"></span> Usuarios</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading"><span class="glyphicon glyphicon-filter"></span> Filtros</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">                        
                                        <div class="form-group">
                                            <label for="name" class="col-sm-2 control-label">Buscar: </label>
                                            <div class="col-sm-10">
                                                <input type="name" class="form-control" name="search" id="search" placeholder="Buscar" />
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                                                            
                            </div> 
                            <div class="panel-footer">
                                <button type="button" id="btn_clear" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-erase"></span> Limpiar</button>
                                <button type="submit" id="btn_submit" class="btn btn-primary btn-lg pull-right"><span class="glyphicon glyphicon-search"></span> Buscar</button>
                            </div>
                        </div>                                                                            
                    </div>
                    <div id="overlay">
                        <div id="text"><span id="spinner" class="glyphicon glyphicon-repeat normal-right-spinner"></span> Buscando</div>
                    </div>                                    
                </div>                
                <div class="row">
                    <div class="col-md-12">                        
                        <table id="tblUsers" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>País</th>
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
    </form>
@stop
@push('js')
    <script src="public/js/general.js"></script>
    <script src="//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.js"></script>
    <script type="text/javascript">
        let tblUsers;
        let tblUsersData={!!$data??"[]"!!};
        $(document).ready(function() {
            tblUsers=$('#tblUsers').DataTable({
            "data": tblUsersData,
            "scrollX": true,
            "searching": false,
            "order": [ 0, "desc"],
            columns: [
                { "data": "id" },
                { "data": "name" },
                { "data": "email" },
                { "data": "country_name" },
                { "data": "created_at" },
                { "data": "updated_at" },
                { "data": "deleted_at" },
            ]
            });            
            $("#btn_clear").click(function(){
                $("#search").val("");
                searchUsers();
            });
            $("#frmUser").submit(function(){
                let bool_cont=true;
                if($("#search").val().trim().length<3){
                    errorctr(false,$("#search"),'Debes ingresar minimo 3 caracteres.');
                    bool_cont=false;
                }
                else{
                    errorctr(true,$("#search"));
                }                                                
                if(bool_cont==true){
                    searchUsers();
                }
                return false;                  
            });
        });
        function searchUsers(){
            $("#overlay").show();
            $.post('/user-search',$('#frmUser').serialize(), function( reponse ) {
                tblUsersData=reponse;
                tblUsers.clear();
                tblUsers.rows.add(tblUsersData);
                tblUsers.draw();                        
                $("#overlay").hide();
            }, "json").fail(function(){
                alert("Se genero un error por favor intente mas tarde.");
                $("#overlay").hide();
            });
        }
    </script>
@endpush