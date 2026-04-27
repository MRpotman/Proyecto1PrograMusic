<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ItemListaDeseos extends Model {
    protected $table = 'item_lista_deseos';
    protected $primaryKey = 'itemListaID';
    const CREATED_AT = 'fechaAgregado';
    const UPDATED_AT = null;
    protected $fillable = ['listaDeseosID', 'productoID'];

    public function listaDeseos() {
        return $this->belongsTo(ListaDeseos::class, 'listaDeseosID');
    }
    public function producto() {
        return $this->belongsTo(Producto::class, 'productoID');
    }
}