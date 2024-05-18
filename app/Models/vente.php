<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vente extends Model
{
    use HasFactory;

    protected $table = 'vente';
    protected $primaryKey = 'id_vente';

    protected $fillable = [
       'id_vente', 'vendeur', 'prestataire', 'csve', 'pdv', 'idproduit'
    ];

    public $timestamps = false;
    public function produit()
    {
        return $this->belongsTo(produit::class, 'idproduit');
    }

    // Définissez la relation "hasMany" vers les objectifs
    public function objectif()
    {
        return $this->hasMany(objectif::class, 'id_vente', 'id_vente');
    }
    
}
