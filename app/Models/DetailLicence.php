<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
use Mehradsadeghi\FilterQueryString\FilterQueryString;

class DetailLicence extends Model
{
    use HasFactory, SoftDeletes, FilterQueryString;

    protected $fillable = [
        'CodeDetailLicence',
        'serie',
        'codeDouane',
        'codePaysOrg',
        'quantite',
        'codeDevice',
        'prixUnit',
        'unitStat',
        'DateSaisie'
    ];
    protected $filters = [
        'sort',
        'by',
        'id',
        'CodeDetailLicence',
        'serie',
        'codeDouane',
        'codePaysOrg',
        'quantite',
        'codeDevice',
        'prixUnit',
        'unitStat',
        'DateSaisie'
    ];

    public function by($query, $value)
    {
        return $query->where('CodeDetailLicence', $value)
            ->orWhere('serie', $value)
            ->orWhere('codeDouane', $value) 
            ->orWhere('codePaysOrg', $value)
            ->orWhere('quantite', $value)
            ->orWhere('codeDevice', $value)
            ->orWhere('unitStat', $value)
            ->orWhere('DateSaisie', $value);
    }
}