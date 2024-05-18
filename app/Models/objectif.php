<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class objectif extends Model
{
    use HasFactory;
    protected $table= 'objectif';
    protected $primaryKey = 'ido';
    protected $fillable =[
    
        'id_mois','mois','objectif','realisation','id_vente'
    ];
    public $timestamps =false;
}
