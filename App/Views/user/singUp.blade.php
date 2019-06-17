@extends('plantilla.page')
@section('title', 'Registro')

@push('css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css">
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
    <form class="form-horizontal" name="frmSingUp" id="frmSingUp" action="/user" method="POST">
        <div class="alert alert-danger" role="alert" id="divErrors">
            <div class="alertBody">                
            </div>
        </div>                    
        <div class="panel panel-default">
            <div class="panel-heading"><span class="glyphicon glyphicon-lock"></span> Registro</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">                        
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Nombre completo: </label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control" name="name" id="name" placeholder="Nombre completo" />
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">                        
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Correo: </label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Correo" />
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">                        
                        <div class="form-group">
                            <label for="country_id" class="col-sm-2 control-label">País: </label>
                            <div class="col-sm-10">
                                <select name="country_id" id="country_id" class="form-control custom-select">
                                    <option value="none">Selecciona tu país</option>
                                    @foreach ($countries as $country)
                                        <option value="{{$country->id??""}}">{{$country->name}} ({{$country->code}})</option>
                                    @endforeach
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">                        
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">Contraseña: </label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" />
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">                        
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">Confirmar contraseña: </label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="passwordConfirme" id="passwordConfirme" placeholder="Confirmar contraseña" />
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer text-right"><button type="submit" id="btn_submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-floppy-disk"></span> Registrarse</button></div>
        </div>
        <div id="overlay">
            <div id="text"><span id="spinner" class="glyphicon glyphicon-repeat normal-right-spinner"></span> Validando</div>
        </div>            
    </form>
@stop
@push('js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="public/js/general.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#country_id').select2({
                width: '100%',
            });                
            $("#frmSingUp").submit(function(){
                let bool_cont=true;
                if($("#name").val().trim().length<3){
                    errorctr(false,$("#name"),'Debes ingresar tu nombre completo, minimo 3 caracteres.');
                    bool_cont=false;
                }
                else{
                    errorctr(true,$("#name"));
                }
                if(!validateEmail($("#email").val().trim())){
                    errorctr(false,$("#email"),'Debes ingresar una direccion de correo valida.');
                    bool_cont=false;
                }
                else{
                    errorctr(true,$("#email"));
                }
                if($("#country_id").val().trim()=="none"){
                    errorctr(false,$("#country_id"),'Debes seleccionar tu país.');
                    bool_cont=false;
                }
                else{
                    errorctr(true,$("#country_id"));
                }
                if(!validatePassword($("#password").val().trim())){
                    errorctr(false,$("#password"),'La contraseña no cumple los parametros, debe tener minimo 6 caracteres y al menos 1 dígito, acepta los caracteres de la "a" a la "z" en mayúsculas "A-Z" y minúsculas "a-z" y con sus acentos incluyendo ÑñüÜ. También incluye rango de digitos del "0-9", y caracteres especiales "!.@-#+$%^&*?_~/" junto al espacio.');
                    bool_cont=false;
                }
                else{
                    errorctr(true,$("#password"));
                }
                if($("#password").val().trim()!=$("#passwordConfirme").val().trim()){
                    errorctr(false,$("#passwordConfirme"),'Las confirmacion no es igual.');
                    bool_cont=false;
                }
                else{
                    errorctr(true,$("#passwordConfirme"));
                }
                if(bool_cont==true){
                    $("#overlay").show();
                    $.post('/user',$('#frmSingUp').serialize(), function( reponse ) {
                        if(reponse.status==false){
                            let errorsHtml="";
                            $.each(reponse.errors, function( index, value ) {
                                errorsHtml+='<p><span class="glyphicon glyphicon glyphicon-warning-sign"></span> '+value+'</p>';
                            });  
                            $("#divErrors").slideDown(300,function(){
                                $(this).find(".alertBody").html("").append(errorsHtml);
                            });
                            $("#password").val("");                                
                            $("#passwordConfirme").val("");                                
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