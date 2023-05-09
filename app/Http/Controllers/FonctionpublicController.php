<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fonctionpublic;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FonctionpublicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all = DB::table('fonctionpublics')->get();

        if ($all->count()>0) {
           return response()->json(
            [
                'status'=>200,
                'all'=>$all
            ],200
           );
        } else {
            return response()->json(
                [
                    'status' => 404,
                    'message' => 'la table est vide'
                ],
                404
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $detail = Validator::make(
           //
            $request->all(),
            [
                "NumMinTravail"=>'required',
                "Num"=>'required',
                "NomExpatrier"=>'required',
                "LieuNais"=>'required',
                "DateNais"=>'required',
                "DateProgr"=>'required',
                "CodePays"=>'required',
                "Fonction"=>'required',
                "AdresseAffectation"=>'required',
                "Obervation"=>'required',
                "NbreRenouvellement"=>'',
                "NbreNationaux"=>'required',
                "NbreExpatrie"=>'required',
                "Annee"=>'required',
                "CodeMois"=>'required',
                "DateCreation"=>'required',
                "CoNum"=>'required',
                "Status"=>'required'
            ],
         
        ); 
        if ($detail->fails()) {
            return response()->json(
                [
                    'status' => 442,
                    'message' => $detail->messages()
                ],
                442
            );
        } else {
            $insert = DB::table('fonctionpublics')->insert(
                [
                    "NumMinTravail"=>$request->NumMinTravail,
                    "Num"=>$request->Num,
                    "NomExpatrier"=>$request->NomExpatrier,
                    "LieuNais"=>$request->LieuNais,
                    "DateNais"=>$request->DateNais,
                    "DateProgr"=>$request->DateProgr,
                    "CodePays"=>$request->CodePays,
                    "Fonction"=>$request->Fonction,
                    "AdresseAffectation"=>$request->AdresseAffectation,
                    "Obervation"=>$request->Obervation,
                    "NbreRenouvellement"=>$request->NbreRenouvellement,
                    "NbreNationaux"=>$request->NbreNationaux,
                    "NbreExpatrie"=>$request->NbreExpatrie,
                    "Annee"=>$request->Annee,
                    "CodeMois"=>$request->CodeMois,
                    "DateCreation"=>$request->DateCreation,
                    "CoNum"=>$request->CoNum,
                    "Status"=>$request->Status
                ]
            );

            if ($insert) {
                return response()->json(
                    [
                        'status' => 200,
                        'message' => 'Vos Données sont enregistrées avec success'
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'status' => 500,
                        'message' => 'verifiez vos codes'
                    ],
                    500
                );
            }

        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $id_data = Fonctionpublic::find($id);

        if ($id_data) {
            return response()->json(
                [
                    'status'=>200,
                    'id_data'=>$id_data
                ]
            );
        } else {
              return response()->json(
                [
                    'status'=>404,
                    'message'=>'cet id nexiste pas'
                ],404
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fonctionpublic $fonctionpublic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fonctionpublic $fonctionpublic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fonctionpublic $fonctionpublic)
    {
        //
    }
}
