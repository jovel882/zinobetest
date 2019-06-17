<?php
    use Illuminate\Events\Dispatcher;
    use Illuminate\Container\Container;
    use Illuminate\Database\Capsule\Manager as Capsule;
    $capsule = new Capsule;
    
    $dotenv = Dotenv\Dotenv::create(__DIR__);
    $dotenv->load();
    $capsule->addConnection([
        'driver'    => 'mysql',
        'host'      => getenv('DDBB_HOST'),
        'database'  => getenv('DDBB'),
        'username'  => getenv('DDBB_USER'),
        'password'  => getenv('DDBB_PASSWORD'),
        'charset'   => 'utf8mb4',
        'collation' => 'utf8mb4_general_ci',
        'prefix'    => '',
    ]);
    $capsule->setEventDispatcher(new Dispatcher(new Container));
    $capsule->setAsGlobal();
    $capsule->bootEloquent();    

?>