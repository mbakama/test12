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

        if ($all->count() > 0) {
            return response()->json(
                [
                    'status' => 200,
                    'all' => $all
            ],
            200
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
            "NumMinTravail" => 'bail|required|numeric',
            "Num" => 'bail|required|numeric',
            "NomExpatrier" => 'bail|required',
            "LieuNais" => 'bail|required',
            "DateNais" => 'bail|required',
            "DateProgr" => 'bail|required',
            "CodePays" => 'bail|required|numeric',
            "Fonction" => 'bail|required|',
            "AdresseAffectation" => 'bail|required|alpha',
            "Obervation" => 'bail|required|numeric',
            "NbreRenouvellement" => 'nullable',
            "NbreNationaux" => 'bail|required|numeric',
            "NbreExpatrie" => 'bail|required|numeric',
            "Annee" => 'bail|required',
            "CodeMois" => 'bail|required|numeric',
            "DateCreation" => 'bail|required',
            "CoNum" => 'bail|required|numeric',
            "Status" => 'bail|required|boolean'
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
                "NumMinTravail" => $request->NumMinTravail,
                "Num" => $request->Num,
                "NomExpatrier" => $request->NomExpatrier,
                "LieuNais" => $request->LieuNais,
                "DateNais" => $request->DateNais,
                "DateProgr" => $request->DateProgr,
                "CodePays" => $request->CodePays,
                "Fonction" => $request->Fonction,
                "AdresseAffectation" => $request->AdresseAffectation,
                "Obervation" => $request->Obervation,
                "NbreRenouvellement" => $request->NbreRenouvellement,
                "NbreNationaux" => $request->NbreNationaux,
                "NbreExpatrie" => $request->NbreExpatrie,
                "Annee" => $request->Annee,
                "CodeMois" => $request->CodeMois,
                "DateCreation" => $request->DateCreation,
                "CoNum" => $request->CoNum,
                "Status" => $request->Status
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
                    'status' => 200,
                    'id_data' => $id_data
            ]
            );
        } else {
            return response()->json(
                [
                    'status' => 404,
                    'message' => 'cet id nexiste pas'
            ],
            404
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
    public function update(Request $request, $id)
    {
        $updates = Validator::make(
            //
            $request->all(),
        [
            "NumMinTravail" => 'bail|required|numeric',
            "Num" => 'bail|required|numeric',
            "NomExpatrier" => 'bail|required',
            "LieuNais" => 'bail|required',
            "DateNais" => 'bail|required',
            "DateProgr" => 'bail|required',
            "CodePays" => 'bail|required|numeric',
            "Fonction" => 'bail|required|',
            "AdresseAffectation" => 'bail|required|alpha',
            "Obervation" => 'bail|required|numeric',
            "NbreRenouvellement" => 'nullable',
            "NbreNationaux" => 'bail|required|numeric',
            "NbreExpatrie" => 'bail|required|numeric',
            "Annee" => 'bail|required',
            "CodeMois" => 'bail|required|numeric',
            "DateCreation" => 'bail|required',
            "CoNum" => 'bail|required|numeric',
            "Status" => 'bail|required|boolean'
        ],

        );
        if ($updates->fails()) {
            return response()->json(
                [
                    'status' => 442,
                    'message' => $updates->messages()
            ],
            442
            );
        } else {
            $update = Fonctionpublic::find($id)->update(
                [
                "NumMinTravail" => $request->NumMinTravail,
                "Num" => $request->Num,
                "NomExpatrier" => $request->NomExpatrier,
                "LieuNais" => $request->LieuNais,
                "DateNais" => $request->DateNais,
                "DateProgr" => $request->DateProgr,
                "CodePays" => $request->CodePays,
                "Fonction" => $request->Fonction,
                "AdresseAffectation" => $request->AdresseAffectation,
                "Obervation" => $request->Obervation,
                "NbreRenouvellement" => $request->NbreRenouvellement,
                "NbreNationaux" => $request->NbreNationaux,
                "NbreExpatrie" => $request->NbreExpatrie,
                "Annee" => $request->Annee,
                "CodeMois" => $request->CodeMois,
                "DateCreation" => $request->DateCreation,
                "CoNum" => $request->CoNum,
                "Status" => $request->Status
            ]
            );

            if ($update) {
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
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $delete = Fonctionpublic::find($id);

        if ($delete) {
            $delete->delete();
            return response()->json(
                [
                    'status' => 200,
                    'message' => 'vous avez supprimeé une donnée avec success'
            ],
            200
            );
        } else {
            return response()->json(
                [
                    'status' => 404,
                    'message' => 'cet id n\'existe pas'
            ],
            404
            );
        }

    }
    public function restorer($id)
    {
        $data = Fonctionpublic::withTrashed()->find($id);

        if ($data && $data->trashed()) {
            $data->restore();

            return response()->json([
                'status' => 200,
                'message' =>
                'felicitation vous avez restoré un enregistrement'
            ], 200);
        } else {
            if (isset($data->id)) {
                return response()->json([
                    'status' => 500,
                    'message' => 'cette donnée a été déja restorée'
                ], 500);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'cet id n\'existe pas'
                ], 404);
            }
        }
    }

    public function restorerAll()
    {
        // ce bout de code nous permet de restorer toutes les données qui ont été supprimés
        $restores = Fonctionpublic::onlyTrashed();
        //dabord on execute cette instruction pour verifier dans la base de donnee s'il y a des donnees effaces
        if ($restores->count() > 0) {
            $restores->restore(); 
            return response()->json([
                'status' => 200,
                'message' => 'toutes les données supprimées ont été restorées'
            ], 200);
        } else {
            return response()->json(
                [
                    'status' => 404,
                    'message' => 'rien a restoré pour le moment'
            ],
            404
            );
        }
    }
}