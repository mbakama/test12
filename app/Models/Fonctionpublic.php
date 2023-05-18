<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mehradsadeghi\FilterQueryString\FilterQueryString;
class Fonctionpublic extends Model
{
    use HasFactory, SoftDeletes, FilterQueryString;

    protected $fillable = ['NumMinTravail',
'Num',
'NomExpatrier',
'LieuNais',
'DateNais',
'DateProgr',
'CodePays',
'Fonction',
'AdresseAffectation',
'Obervation',
'NbreRenouvellement',
'NbreNationaux',
'NbreExpatrie',
'Annee',
'CodeMois',
'DateCreation',
'CoNum',
'Status'];

protected $filters = ['sort','by'];

public function by($query,$value){
    return $query->where('NumMinTravail',$value)
    ->orWhere('NomExpatrier',$value)
    ->orWhere('LieuNais',$value)
    ->orWhere('DateNais',$value)
    ->orWhere('CodePays',$value)
    ->orWhere('Fonction',$value)
    ->orWhere('AdresseAffectation',$value)
    ->orWhere('Annee',$value)
    ->orWhere('DateCreation',$value)
    ->orWhere('CodePays',$value);
}
}
