@extends('plantilla.page')
@section('title', 'Inicio')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading"><span class="glyphicon glyphicon-paperclip"></span> Información</div>
        <div class="panel-body">
            <div class="panel panel-success">
                <div class="panel-heading"><span class="glyphicon glyphicon-thumbs-up"></span> Caracteristicas</div>
                <div class="panel-body">
                    <p>&bull; Funcionalidades de autenticacion, autorizaci&oacute;n, ingreso y registro.</p>
                    <p><br />&bull; Configuraci&oacute;n Inicial con los componentes necesarios, carga del contenedor de servicios de Laravel para el manejo de inyecci&oacute;n de dependencias, registro de los proveedores de servicios necesarios de los componente de rutas y el de eventos necesario para este ultimo y otros mas como el de la BD,etc.</p>
                    <p><br />&bull; Rutas y rewrite para url amigables.</p>
                    <p>&bull; Desarrollo de modelos eloquent con relaciones he interfaz de los mismos para la inyecci&oacute;n desde el proveedor de servicio en cada uno de sus controladores.&nbsp;&nbsp;</p>
                    <div>&bull; Controladores para cada modulo y controllador base para hacer la inyeccion desde el proveedor de servicio.&nbsp;&nbsp;</div>
                    <div><br />&bull; Proveedor de servicio para hacer la inyecci&oacute;n de dependencias para inicializar todos los controladores con acceso al manejador de vistas y cada cada uno de sus modelos.</div>
                    <div>&nbsp;</div>
                    <div>&bull; Desarrollo de la plantilla base y extendido a las dem&aacute;s vistas con todo con Blade.</div>
                    <div>&nbsp;</div>
                    <div>&bull; Desarrollo de las vistas con Blade.&nbsp;&nbsp;</div>
                    <div>&nbsp;</div>
                    <div>&bull; Clase de autenticar y autorizar.</div>
                    <div>&nbsp;</div>
                    <div>&bull; Desarrollo de sistema de validaci&oacute;n con el patron estrategia,junto a clase para usar la validaci&oacute;n unique.&nbsp;&nbsp;</div>
                    <div>&nbsp;</div>
                    <div>&bull; Funcionalidades de autenticacion, autorizaci&oacute;n, ingreso y registro.</div>
                    <p>&bull; Desarrollo de los m&oacute;dulos de visualizaci&oacute;n y b&uacute;squeda para usaurios y paises.</p>
                    <p><br />&bull; Aseguramiento de ejecuci&oacute;n de script php diferentes al index.php con reglas en el archivo .htaccess. Tambien se evito la visualizacion del archivo .env y los archivos de configuracion de composer.</p>
                    <p><br />&bull; Desarrollo de comando para la configuraci&oacute;n del archivo .env y realizar la creaci&oacute;n de las tablas de la BD junto con sus datos de ejemplo.</p>
                    <p><br />&bull; Desarrollo para el manejo de excepciones.</p>
                    <p>&nbsp;</p>                                      
                </div> 
            </div>                                                                            
            <div class="panel panel-warning">
                <div class="panel-heading"><span class="glyphicon glyphicon-alert"></span> Faltantes</div>
                <div class="panel-body">
                    <div>Por falta de tiempo no cuenta con:</div>
                    <div>&nbsp;</div>
                    <div>&bull; Validacion CSRF.<br />
                    <div>&nbsp;</div>
                    </div>
                    <div>
                    <div>Por falta de de domino no cuenta con:</div>
                    <div>&nbsp;</div>
                    <div>&bull; Prueba unitarias, no tengo experiencia en esta practica, aunque en ello trabajo actualmente.</div>
                    </div>
                    <div>&nbsp;</div>
                    <div><span style="color: #339966;"><strong>No pude hacer el flujo sobre el repositorio ya que no pod&iacute;a realizar ning&uacute;n push, con lo cual cree un proyecto en en github y simule el flujo de los commits a la nueva rama develop y luego el pull request a master.</strong></span></div>
                    <div>&nbsp;</div>
                    <div><span style="color: #339966;"><strong>La url del repo es:</strong></span></div>
                    <div>&nbsp;</div>
                    <div><a href="https://github.com/jovel882/zinobetest" target="_blank">https://github.com/jovel882/zinobetest</a>&nbsp;</div>
                </div> 
            </div>                                                                            
        </div>            
    </div>    
@stop