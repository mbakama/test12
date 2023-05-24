<?php

namespace App\Http\Controllers;

use App\Models\DetailDgm;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB;
use App\Http\Resources\DetailResource;
use Illuminate\Support\Facades\Validator;


class DetailDgmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = DetailDgm::filter();

        if (count($query->get()) > 0) {

            return [
                "nombre de données trouver" => count($query->get()),
                "Donnees trouvées" => $query->paginate(10)
            ];
        } else {
            return response()->json(
                [
                    'status' => 404,
                    'message' => 'Desolé, nous n\'avons pas trouvé les données correspondants'
                ],
                404
            );
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                "NumDGM" => 'required|numeric',
                "Num" => 'required|numeric',
                "Nom" => 'nullable',
                "Postnon" => 'nullable',
                "Sexe" => 'numeric|nullable',
                "EtatCivil" => 'nullable',
                "CodePays" => 'numeric|nullable',
                "DateNais" => 'date|nullable',
                "Profession" => 'nullable',
                "CodTypeVisa" => 'numeric|nullable',
                "LibellePaysAjout" => 'nullable',
                "DatExpirationVisa" => 'date|nullable',
                "CoNum" => 'numeric|required',
                "DateSaisie" => 'date|required',
                "Statut" => 'required|boolean',
                "Annee" => 'required|string'
            ]
        );

        if ($validation->fails()) {
            return response()->json(
                [
                    'status' => 404,
                    'message' => $validation->messages()
                ]
            );
        } else {
            $store = DB::table('detail_dgms')->insert(
                [
                    "NumDGM" => $request->NumDGM,
                    "Num" => $request->Num,
                    "Nom" => $request->Nom,
                    "Postnon" => $request->PostNom,
                    "Sexe" => $request->Sexe,
                    "EtatCivil" => $request->EtatCivil,
                    "CodePays" => $request->CodePays,
                    "DateNais" => $request->DateNais,
                    "Profession" => $request->Profession,
                    "CodTypeVisa" => $request->CodTypeVisa,
                    "LibellePaysAjout" => $request->LibellePaysAjout,
                    "DatExpirationVisa" => $request->DatExpirationVisa,
                    "CoNum" => $request->CoNum,
                    "DateSaisie" => $request->DateSaisie, 
                    "Annee" => $request->Annee,
                    "Statut" => $request->Statut
                ]
            );

            if ($store) {
                return response()->json(
                    [
                        'status' => 201,
                        'message' => 'Vos Données sont enregistrées avec success'
                    ],
                    201
                );
            } else {
                return response()->json(
                    [
                        'status' => 500,
                        'message' => 'il y a une erreur potentiele dans votre code, corrige la et ressaye'
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
        $details = DetailDgm::find($id);

        if ($details) {
            return new DetailResource($details);
        } else {
            return response()->json([
                'statut' => 404,
                'message' => 'cet id n\'existe pas ou a été supprimé'
            ], 404);
        }
    } 
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(),
        [
            "NumDGM" => 'required|numeric',
                "Num" => 'required|numeric',
                "Nom" => 'nullable',
                "Postnon" => 'nullable',
                "Sexe" => 'numeric|nullable',
                "EtatCivil" => 'nullable',
                "CodePays" => 'numeric|nullable',
                "DateNais" => 'date|nullable',
                "Profession" => 'nullable',
                "CodTypeVisa" => 'numeric|nullable',
                "LibellePaysAjout" => 'nullable',
                "DatExpirationVisa" => 'date|nullable',
                "CoNum" => 'numeric|required',
                "DateSaisie" => 'date|required',
                "Statut" => 'required|boolean',
                "Annee" => 'required|string'
        ]);

        if ($validation->fails()) {
            return response()->json(
                [
                    'status'=>404,
                    'messages'=>$validation->messages()
                ]
            );
        } else {
            $update = DetailDgm::find($id)
            ->update(
                   [ 
                    "NumDGM" => $request->NumDGM,
                    "Num" => $request->Num,
                    "Nom" => $request->Nom,
                    "Postnon" => $request->PostNom,
                    "Sexe" => $request->Sexe,
                    "EtatCivil" => $request->EtatCivil,
                    "CodePays" => $request->CodePays,
                    "DateNais" => $request->DateNais,
                    "Profession" => $request->Profession,
                    "CodTypeVisa" => $request->CodTypeVisa,
                    "LibellePaysAjout" => $request->LibellePaysAjout,
                    "DatExpirationVisa" => $request->DatExpirationVisa,
                    "CoNum" => $request->CoNum,
                    "DateSaisie" => $request->DateSaisie, 
                    "Annee" => $request->Annee,
                    "Statut" => $request->Statut
                    ]
            );

            if ($update) {
                return response()->json(
                    [
                        'status' => 201,
                        'message' => 'Vos données ont été modifiées avec success'
                    ],
                    201
                );
            } else {
                return response()->json(
                    [
                        'stutus' => 404,
                        'message' => 'Desolé ! il parait que l\'id que vous voulez porter de modification n\'existe pas'
                    ],
                    404
                );
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $delete = DetailDgm::find($id);

        if ($delete) {
            $delete->delete();

            return response()->json(
                [
                    'status' => 201,
                    'message' => 'donnée supprimée avec success'
                ],
                201
            );
        } else {
            return response()->json(
                [
                    'status' => 404,
                    'message' => 'Desolé ! il parait que l\'id que vous voulez supprimer n\'existe pas'
                ],
                404
            );
        }
    }
}