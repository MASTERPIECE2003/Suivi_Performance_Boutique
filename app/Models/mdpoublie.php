<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mdpoublie extends Model
{
    use HasFactory;
    protected $table= 'mdpoublie';
    protected $fillable =[
    
        'motcle','iduser'
    ];
    public $timestamps =false;
}
