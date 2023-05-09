<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fonctionpublic extends Model
{
    use HasFactory, SoftDeletes;

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
}
