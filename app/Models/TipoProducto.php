<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TipoProducto extends Model {
    protected $table = 'tipo_productos';
    protected $primaryKey = 'tipoProductoID';
    public $timestamps = false;
    protected $fillable = ['nombre', 'descripcion'];

    public function productos() {
        return $this->hasMany(Producto::class, 'tipoProductoID');
    }
}