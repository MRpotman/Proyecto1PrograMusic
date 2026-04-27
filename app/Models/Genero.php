<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Genero extends Model {
    protected $table = 'generos';
    protected $primaryKey = 'generoID';
    public $timestamps = false;
    protected $fillable = ['nombre'];

    public function productos() {
        return $this->hasMany(Producto::class, 'generoID');
    }
}