<?php
    use Illuminate\Http\Request;
    use App\Auth\Auth;

    $request = Illuminate\Http\Request::createFromGlobals();

    $app['router']->get('/', function() use ($app){
        return $app['app']->make('App\Controllers\UserController')->home();
    });
    $app['router']->get('/country', function() use ($app){
        return $app['app']->make('App\Controllers\CountryController')->index(new Auth());
    });
    $app['router']->get('/user', function() use ($app){
        return $app['app']->make('App\Controllers\UserController')->index(new Auth());
    });
    $app['router']->post('/user', function() use ($app,$request){
        return $app['app']->make('App\Controllers\UserController')->storage($request);
    });
    $app['router']->post('/user-search', function() use ($app,$request){
        return $app['app']->make('App\Controllers\UserController')->search($request);
    });
    $app['router']->get('/login', function() use ($app){
        return $app['app']->make('App\Controllers\UserController')->loginLoad(new Auth(true));
    });
    $app['router']->post('/login', function() use ($app,$request){    
        return $app['app']->make('App\Controllers\UserController')->login($request);
    });
    $app['router']->get('/sign-up', function() use ($app){
        return $app['app']->make('App\Controllers\UserController')->singUpLoad(new Auth(true));
    });
    $app['router']->get('/logout', function(){    
        Auth::delete();
    });
?>