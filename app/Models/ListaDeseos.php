<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ListaDeseos extends Model {
    protected $table = 'lista_deseos';
    protected $primaryKey = 'listaDeseosID';
    const CREATED_AT = 'fechaCreacion';
    const UPDATED_AT = null;
    protected $fillable = ['usuarioID'];

    public function usuario() {
        return $this->belongsTo(Usuario::class, 'usuarioID');
    }
    public function items() {
        return $this->hasMany(ItemListaDeseos::class, 'listaDeseosID');
    }
}