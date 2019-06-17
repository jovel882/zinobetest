@extends('plantilla.page')
@section('title', 'Login')

@push('css')
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
    <form class="form-horizontal" name="frmLogin" id="frmLogin" action="/login" method="POST">
        <div class="alert alert-danger" role="alert" id="divErrors">
            <div class="alertBody">                
            </div>
        </div>                    
        <div class="panel panel-default">
            <div class="panel-heading"><span class="glyphicon glyphicon-user"> Login</div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Correo</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Correo" />
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">Contraseña</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" />
                        <span class="help-block"></span>
                    </div>
                </div>
            </div>
            <div class="panel-footer text-right"><button type="submit" id="btn_submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-menu-right"></span> Ingresar</button></div>
        </div>
        <div id="overlay">
            <div id="text"><span id="spinner" class="glyphicon glyphicon-repeat normal-right-spinner"></span> Validando</div>
        </div>            
    </form>
@stop
@push('js')
    <script src="public/js/general.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {    
            $("#frmLogin").submit(function(){
                let bool_cont=true;
                if(!validateEmail($("#email").val().trim())){
                    errorctr(false,$("#email"),'Debes ingresar una direccion de correo valida.');
                    bool_cont=false;
                }
                else{
                    errorctr(true,$("#email"));
                }
                if(!validatePassword($("#password").val().trim())){
                    errorctr(false,$("#password"),'La contraseña no cumple los parametros, debe tener minimo 6 caracteres y al menos 1 dígito, acepta los caracteres de la "a" a la "z" en mayúsculas "A-Z" y minúsculas "a-z" y con sus acentos incluyendo ÑñüÜ. También incluye rango de digitos del "0-9", y caracteres especiales "!.@-#+$%^&*?_~/" junto al espacio.');
                    bool_cont=false;
                }
                else{
                    errorctr(true,$("#password"));
                }
                if(bool_cont==true){
                    $("#overlay").show();
                    $.post('/login',$('#frmLogin').serialize(), function( reponse ) {
                        if(reponse.status==false){
                            let errorsHtml="";
                            if(reponse.errors){
                                $.each(reponse.errors, function( index, value ) {
                                    errorsHtml+='<p><span class="glyphicon glyphicon-warning-sign"></span> '+value+'</p>';
                                });  
                            }
                            else{
                                errorsHtml='<p><span class="glyphicon glyphicon-warning-sign"></span> Usuario y/o contraseña incorectas.</p>';
                            }
                            $("#divErrors").slideDown(300,function(){
                                $(this).find(".alertBody").html("").append(errorsHtml);
                            });
                            $("#password").val("");                                
                        }
                        else{
                            window.location=reponse.url;
                        }
                        $("#overlay").hide();
                    }, "json").fail(function(){
                        alert("Se genero un error por favor intente mas tarde.");
                        $("#overlay").hide();
                    });                     
                }
                return false;                  
            });
        });
    </script>
@endpush