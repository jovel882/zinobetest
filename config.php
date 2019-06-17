<?php
    echo "\n\e[0;30;42mInicio Configuracion.\e[0m\n\n";
    $varsSearch=array("ENV=","DDBB_HOST=","DDBB_USER=","DDBB_PASSWORD=","DDBB=");
    $varsInsert=[];
    $bool_dbMigrate=true;
    $carpeta = 'cache';
    if (!file_exists($carpeta)) {
        mkdir($carpeta, 0777, true);
        echo "\e[0;32;40mSe creo la carpeta de cache correctamente.\e[0m\n\n";
    }        
    foreach($argv as $arg){
        foreach($varsSearch as $var){
            if(strpos($arg, $var) !== false) {
                array_push($varsInsert,$arg);
                break;
            }
        }
        if($arg == "--notDbMigrate") {
            $bool_dbMigrate=false;
        }
    }    
    
    if(count($varsInsert)==5){
        $fichero = '.env';
        $envText = '';
        foreach($varsInsert as $var){
            $envText.=$var."\n";
        }
        file_put_contents($fichero, $envText);    
        echo "\e[0;32;40mSe cargaron las variables de entorno correctamente.\e[0m\n\n";
    }
    else if(count($varsInsert)>0){
        echo "\e[0;31;40mSe detectaron algunas variables de entorno, pero se requieren todas. No se cargo ninguna.\e[0m\n\n";
    }
    else{
        echo "\e[0;33;40mNo se cargaron las variables de entorno.\e[0m\n\n";
    }

    require 'vendor/autoload.php';
    use Illuminate\Database\Capsule\Manager as Capsule;
    use App\Models\User;
    use App\Models\Country;
    if($bool_dbMigrate==true){
        if(Capsule::schema()->hasTable('users')){
            Capsule::schema()->dropIfExists('users');
            echo "\e[1;32;40mSe elimino la tabla de usuarios.\e[0m\n\n";
        }
        if(Capsule::schema()->hasTable('countries')){
            Capsule::schema()->dropIfExists('countries');
            echo "\e[1;32;40mSe elimino la tabla de paises.\e[0m\n\n";
        }
        Capsule::schema()->create('countries', function ($table) {
            $table->increments('id');
            $table->string('code',3);
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });
        echo "\e[1;32;40mSe creo la tabla de paises.\e[0m\n\n";
        Capsule::schema()->create('users', function ($table) {
            $table->increments('id');
            $table->unsignedInteger('country_id');
            $table->string('name');
            $table->string('password');
            $table->string('email')->unique();
            $table->timestamps();
            $table->softDeletes();
            $table->index('country_id');
            $table->foreign('country_id')
            ->references('id')->on('countries')
            ->onUpdate('cascade')            
            ->onDelete('cascade');    
        });
        echo "\e[1;32;40mSe creo la tabla de usuarios.\e[0m\n\n";
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, 'https://pkgstore.datahub.io/core/country-list/data_json/data/8c458f2d15d9f2119654b29ede6e45b8/data_json.json');
        $result = curl_exec($ch);
        curl_close($ch);
        // Capsule::enableQueryLog();
        $obj = json_decode($result);
        $countries=array();
        foreach ($obj as $value) {
            array_push($countries,[
                'code' => $value->Code,
                'name' => $value->Name,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')        
            ]);
        }
        $country = Country::insert($countries);
        echo "\e[1;32;40mSe cargaron los paises desde https://pkgstore.datahub.io/core/country-list/data_json/data/8c458f2d15d9f2119654b29ede6e45b8/data_json.json.\e[0m\n\n";    
        $users=array();
        $faker = Faker\Factory::create();
        for($i=0;$i<50;$i++){
            $name=$faker->name;
            array_push($users,[
                'country_id' => Country::inRandomOrder()->first()->id,
                'name' => $name,
                'email' => $faker->unique()->freeEmail,
                'password' => password_hash(substr($name,0,6).'2019', PASSWORD_BCRYPT), 
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')        
                ]);
        }
        User::insert($users);
        echo "\e[1;32;40mSe cargaron 50 usuarios de prueba, la clave de acceso asignada para todos es los primeros 6 caracteres del nombre junto con 2019 Ej Si mi nombre en BD es \"John Fredy Velasco Bareño\" mi clave de acceso seria \"John F2019\".\e[0m\n\n";     
    }
    else{
        echo "\e[0;33;40mNo se migro la BD.\e[0m\n\n";
    }    
    echo "\e[0;30;42mFinalizo Configuracion.\e[0m\n";
?>