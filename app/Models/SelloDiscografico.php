<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class SelloDiscografico extends Model {
    protected $table = 'sello_discograficos';
    protected $primaryKey = 'selloDiscograficoID';
    public $timestamps = false;
    protected $fillable = ['nombre'];

    public function artistas() {
        return $this->hasMany(Artista::class, 'selloDiscograficoID');
    }
}