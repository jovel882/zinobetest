<?php
    require 'vendor/autoload.php';
    require 'vendor/illuminate/support/helpers.php';
    $app = new Illuminate\Container\Container;
    Illuminate\Support\Facades\Facade::setFacadeApplication($app);

    $app['app'] = $app;
    $app['env'] = getenv('ENV');
    with(new Illuminate\Events\EventServiceProvider($app))->register();
    with(new Illuminate\Routing\RoutingServiceProvider($app))->register();
    with(new App\AppServiceProvider($app))->register();

    require 'routes.php';

    try {
        $request = Illuminate\Http\Request::createFromGlobals();
        $response = $app['router']->dispatch($request);
        $response->send();
    } catch (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $exception) {
        return $app['app']->make('App\Exception\ExceptionManger')->send(new Exception('Pagina no encontrada', 404));
        die();
    } catch (\Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException $exception) {
        return $app['app']->make('App\Exception\ExceptionManger')->send(new Exception('Pagina no encontrada', 404));
        die();
    } catch (PDOException $exception) {
        return $app['app']->make('App\Exception\ExceptionManger')->send($exception);
        die();
    } catch (Exception $exception) {
        return $app['app']->make('App\Exception\ExceptionManger')->send($exception);
        die();
    }
?>