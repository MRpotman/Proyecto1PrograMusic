<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CarritoCompras extends Model {
    protected $table = 'carrito_compras';
    protected $primaryKey = 'carritoID';
    const CREATED_AT = 'fechaCreacion';
    const UPDATED_AT = null;
    protected $fillable = ['usuarioID', 'total'];

    public function usuario() {
        return $this->belongsTo(Usuario::class, 'usuarioID');
    }
    public function items() {
        return $this->hasMany(ItemCarrito::class, 'carritoID');
    }
}