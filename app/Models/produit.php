<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produit extends Model
{
    use HasFactory;
    protected $primaryKey = 'idproduit';
        protected $table= 'produit';
        protected $fillable =[
        
            'idproduit','nom_produit'
        ];
        public $timestamps =false;
}
