<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Agent extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = ['nom','prenom','email','numero','adresse','sexe','etat'];
}
