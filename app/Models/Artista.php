<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Artista extends Model {
    protected $table = 'artistas';
    protected $primaryKey = 'artistaID';
    public $timestamps = false;
    protected $fillable = ['nombre', 'nacionalidad', 'selloDiscograficoID'];

    public function selloDiscografico() {
        return $this->belongsTo(SelloDiscografico::class, 'selloDiscograficoID');
    }
    public function productos() {
        return $this->hasMany(Producto::class, 'artistaID');
    }
}