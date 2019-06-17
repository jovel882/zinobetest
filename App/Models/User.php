<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Interfaces\ModelInterface;
class User extends Model implements ModelInterface
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];    
    protected $guarded = ['id'];
    protected $appends = ['country_name'];

    public function getCountryNameAttribute(){
        return $this->country->name;
    }
    public function getAll(){
        return self::with("country")->get();
    }
    static public function findFromId(int $id){
        return self::find($id);
    }
    static public function findFromLogin(string $email){
        return self::where("email",$email)->first();
    }
    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }    
    public function getAllCountries()
    {
        return $this->first()->country->all();
    }    
    public function createNew(array $fields)
    {
        $fields["password"]=password_hash($fields["password"], PASSWORD_BCRYPT);
        self::create($fields);
    }    
    public function searchByNameEmail(string $search)
    {        
        return self::where('name', 'like', '%'.$search.'%')
            ->orWhere('email', 'like', '%'.$search.'%')
            ->get();
    }    
}

?>