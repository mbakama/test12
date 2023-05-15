<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fonctionpublic;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\DetailResource;
use Illuminate\Support\Facades\Validator;

class FonctionpublicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all = Fonctionpublic::all();

        if ($all->count() > 0) {
            return [
                "Nombres des donnees trouvées"=>count($all),
                "Data"=>DetailResource::collection($all)
            ];
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
public function uploader(Request $request)
{
    $query = $request->file('file')->store('api_store_data');
    return [
        
        "result"=>$query
    ];
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
            return new DetailResource($id_data);
        } else {
            return response()->json(
                [
                    'status' => 404,
                    'message' => 'l\'id n\'existe pas dans notre table'
                ],
                404
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
   

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
            $update = Fonctionpublic::find($id);

            if ($update) {
            
                    $update->update(
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
                "Status" => $request->Status,
            ]
            );

            if ($update) {
                return response()->json(
                    [
                        'status' => 200,
                        'message' => 'Vos Données ont modifié avec success'
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'status' => 500,
                        'message' => 'il y a une erreur'
                    ],
                    500
                );
            }
        } else {
            return response()->json(
                [
                    'status' => 404,
                    'message' => 'l\'id n\'existe pas dans notre table'
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
        $delete = Fonctionpublic::find($id);

        if ($delete) {
            
                $delete->delete();

                return response()->json(
                    [
                        'status' => 200,
                        'message' => 'donnée supprimée avec success'
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'status' => 404,
                        'message' => 'l\'id que vous avez inseré n\'existe pas ou a été effacé'
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
                    'message' => 'il se peut que vous ayez déja restoré toutes les données supprimées car nous n\'avons trouvé aucune donnée a restoré'
                ],
                404
            );
        }
    }
    public function all_data()
    {
        $query = Fonctionpublic::withTrashed()->get();

        if ($query) {

            return [
                "Nombre de donnees trouvées"=>count($query),
                "Data"=>DetailResource::collection($query)
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
    public function search(Request $request)
    {
        $query = Fonctionpublic::query();
        //ce bout de code nous permet de faire une recherche automatique selon les colonnes que nous avons defini 
        if ($s = $request->input('search')) {
            $query->whereRaw("NomExpatrier LIKE '%" . $s . "%'")
                ->orWhereRaw("LieuNais LIKE '%" . $s . "%'")
                ->orWhereRaw("DateNais LIKE '%" . $s . "%'")
                ->orWhereRaw("Fonction LIKE '%" . $s . "%'")
                ->orWhereRaw("AdresseAffectation LIKE '%" . $s . "%'")
                ->orWhereRaw("Annee LIKE '%" . $s . "%'")
                ->orWhereRaw("DateCreation LIKE '%" . $s . "%'")
                ->orWhereRaw("CodePays LIKE '%" . $s . "%'")
                ->orWhereRaw("NumMinTravail LIKE '%" . $s . "%'")
                ->orWhereRaw("Num LIKE '%" . $s . "%'")
                ;

            if ($count = count($query->get()) > 0) {
                return [
                    "nombre de données trouver"=>count($query->get()),
                    "Donnees trouvées"=>$query->get()
                ]
                
                ;
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
        //filtrer selon la colonne serie /asc ou desc
        if ($sort = $request->input('sort')) {
            $query->orderBy('serie', $sort);
            return $query->get();
        }
        //    pagination 
        $perPage = 10;
        $page = request('page', default: 1);
        $total = $query->count();
        $fetch = $query->offset(($page - 1) * $perPage)->limit($perPage)->get();

        return [
            'data' => $fetch,
            'total' => $total,
            'page' => $page,
            'Derniere_page' => ceil($total / $perPage)
        ];
    }
}