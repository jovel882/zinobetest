@extends('plantilla.page')
@section('title', 'Inicio')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading"><span class="glyphicon glyphicon-paperclip"></span> Información</div>
        <div class="panel-body">
            <div class="panel panel-success">
                <div class="panel-heading"><span class="glyphicon glyphicon-paperclip"></span> Caracteristicas</div>
                <div class="panel-body">
                    <p style="text-align: left;">&bull; Funcionalidades de autenticacion, autorizaci&oacute;n, ingreso y registro.&nbsp;&nbsp;</p>
                    <p style="text-align: left;">
                        <br />&bull; Configuraci&oacute;n Inicial con los componentes necesarios, carga del contenedor de servicios de Laravel para el manejo de inyecci&oacute;n de dependencias, registro de los proveedores de servicios necesarios de los componente de rutas y el de eventos necesario para este ultimo y otros mas como el de la BD,etc.</p>
                    <p style="text-align: left;">
                        <br />&bull; Rutas y rewrite para url amigables.</p>
                    <p style="text-align: left;">&bull; Desarrollo de modelos eloquent con relaciones he interfaz de los mismos para la inyecci&oacute;n desde el proveedor de servicio en cada uno de sus controladores.&nbsp;&nbsp;</p>
                    <div style="text-align: left;">&bull; Controladores para cada modulo y controllador base para hacer la inyeccion desde el proveedor de servicio.&nbsp;&nbsp;</div>
                    <div style="text-align: left;">
                        <br />&bull; Proveedor de servicio para hacer la inyecci&oacute;n de dependencias para inicializar todos los controladores con acceso al manejador de vistas y cada cada uno de sus modelos.</div>
                    <div style="text-align: left;">&nbsp;</div>
                    <div style="text-align: left;">&bull; Desarrollo de la plantilla base y extendido a las dem&aacute;s vistas con todo con Blade.</div>
                    <div style="text-align: left;">&nbsp;</div>
                    <div style="text-align: left;">&bull; Desarrollo de las vistas con Blade.&nbsp;&nbsp;</div>
                    <div style="text-align: left;">&nbsp;</div>
                    <div style="text-align: left;">&bull; Clase de autenticar y autorizar.</div>
                    <div style="text-align: left;">&nbsp;</div>
                    <div style="text-align: left;">&bull; Desarrollo de sistema de validaci&oacute;n con el patron estrategia,junto a clase para usar la validaci&oacute;n unique.&nbsp;&nbsp;</div>
                    <div style="text-align: left;">&nbsp;</div>
                    <div style="text-align: left;">&bull; Funcionalidades de autenticacion, autorizaci&oacute;n, ingreso y registro.</div>
                </div> 
            </div>                                                                            
        </div>            
    </div>    
@stop