<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model {
    protected $table = 'usuarios';
    protected $primaryKey = 'usuarioID';
    const CREATED_AT = 'fechaRegistro';
    const UPDATED_AT = null;
    protected $fillable = ['nombre', 'email', 'password', 'telefono', 'direccion', 'rol'];

    public function carritos() {
        return $this->hasMany(CarritoCompras::class, 'usuarioID');
    }
    public function listaDeseos() {
        return $this->hasMany(ListaDeseos::class, 'usuarioID');
    }
}