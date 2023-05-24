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
        // ce bout de code nous aide a restore une donnée a partir de l'idee fourni par l'utilisateur
        // dans l'url vous pouvez ecrire comme params detailgdms?restore=1
        if ($r = request('restore')) {
       
            $data = DetailDgm::withTrashed()->find($r); 
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
        // ce bout de code, nous permet de faire la pagination, le filtrage asc et desc et aussi recherche des donnees en mass ou par colonne
        // dans l'url vous pouvez ecrire comme params detailgdms?page=1&sort=id,desc&by=STEPHANE ou 
        // ou simplement detailgdms?page=1&sort=id,desc&Postnom=STEPHANE
        $query = DetailDgm::filter();

        if (count($query->get()) > 0) {

            return [
                "nombre de données trouver" => count($query->get()),
                "Donnees trouvées" => $query->paginate(5)
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
 
    public function restorerAll()
    {
        // ce bout de code nous permet de restorer toutes les données qui ont été supprimés
        $restores = DetailDgm::onlyTrashed();
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
                    'message' => 'il se peut que vous ayez déja restoré toutes les données supprimées car nous n\'avons trouvé aucune donnée a restoré'
                ],
                404
            );
        }
    }
    public function all_data()
    {
        $query = DetailDgm::withTrashed()->get();

        if ($query) {

            return [
                "Nombre de donnees trouvées" => count($query),
                "Data" => DetailResource::collection($query)
            ]
            ;
        } else {
            return response()->json(
                [
                    'status' => 404,
                    'message' => 'il y a une erreur'
                ]
            );
        }
    }
}