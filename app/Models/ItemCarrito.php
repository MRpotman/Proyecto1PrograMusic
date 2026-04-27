<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ItemCarrito extends Model {
    protected $table = 'item_carritos';
    protected $primaryKey = 'itemCarritoID';
    public $timestamps = false;
    protected $fillable = ['carritoID', 'productoID', 'cantidad', 'precioUnitario'];

    public function carrito() {
        return $this->belongsTo(CarritoCompras::class, 'carritoID');
    }
    public function producto() {
        return $this->belongsTo(Producto::class, 'productoID');
    }
}