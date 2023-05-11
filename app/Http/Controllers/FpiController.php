<?php

namespace App\Http\Controllers;

use App\Models\Detailfp;
use Illuminate\Http\Request;
use App\Http\Requests\DetailRequest;

use Illuminate\Support\Facades\Auth;
use App\Http\Resources\DetailResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FpiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fetch_data = Detailfp::all();

        if ($fetch_data->count() > 0) {
            //ici on fait appel une ressouce que nous avons creer pour nous retourner facilement les infos sous format Json
            return DetailResource::collection($fetch_data);
        } else {
            return response()->json(
                [
                    'status' => 404,
                    'message' => 'il n\'y a pas des données dans la table'
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
        $val = Validator::make(
            $request->all(),
            [
                'numero' => 'required|numeric',
                'CodeSource' => 'nullable|numeric',
                'MontantCreditFc' => 'required|numeric',
                'MontantCreditUSD' => 'required|numeric',
                'Promoteur' => 'nullable',
                'AdressPromoteur' => 'nullable',
                'observation' => 'numeric|nullable',
                'telephone' => 'numeric|nullable',
                'Annee' => 'nullable|numeric|min:4',
                'CoNum' => 'required|numeric',
                'DateCreation' => 'required',
                'Status' => 'required|boolean'
            ]
        );

        if ($val->fails()) {
            return response()->json(
                [
                    'status' => 404,
                    'message' => $val->messages()
                ]
            );
        } else {
            $insert = DB::table('detailfps')->insert(
                [
                    'numero' => $request->numero,
                    'CodeSource' => $request->CodeSource,
                    'MontantCreditFc' => $request->MontantCreditFc,
                    'MontantCreditUSD' => $request->MontantCreditUSD,
                    'Promoteur' => $request->Promoteur,
                    'AdressPromoteur' => $request->AdressPromoteur,
                    'observation' => $request->observation,
                    'telephone' => $request->telephone,
                    'Annee' => $request->Annee,
                    'CoNum' => $request->CoNum,
                    'DateCreation' => $request->DateCreation,
                    'Status' => $request->Status,
                    'user_id' => Auth::user()->id
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
    public function show(int $id)
    {
        $data = Detailfp::find($id);

        if ($data) {
            return new DetailResource($data);
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $val = Validator::make(
            $request->all(),
            [
                'numero' => 'required|numeric',
                'CodeSource' => 'nullable|numeric',
                'MontantCreditFc' => 'required|numeric',
                'MontantCreditUSD' => 'required|numeric',
                'Promoteur' => 'nullable',
                'AdressPromoteur' => 'nullable',
                'observation' => 'numeric|nullable',
                'telephone' => 'numeric|nullable',
                'Annee' => 'nullable|numeric|min:4',
                'CoNum' => 'required|numeric',
                'DateCreation' => 'required',
                'Status' => 'required|boolean'
            ]
        );

        if ($val->fails()) {
            return response()->json(
                [
                    'status' => 404,
                    'message' => $val->messages()
                ]
            );
        } else {
            $update = Detailfp::find($id);

            if ($update) {
                if ($update->user_id == Auth::user()->id) {
                $update->update(
                    [
                        'numero' => $request->numero,
                        'CodeSource' => $request->CodeSource,
                        'MontantCreditFc' => $request->MontantCreditFc,
                        'MontantCreditUSD' => $request->MontantCreditUSD,
                        'Promoteur' => $request->Promoteur,
                        'AdressPromoteur' => $request->AdressPromoteur,
                        'observation' => $request->observation,
                        'telephone' => $request->telephone,
                        'Annee' => $request->Annee,
                        'CoNum' => $request->CoNum,
                        'DateCreation' => $request->DateCreation,
                        'Status' => $request->Status,
                        'user_id' => Auth::user()->id
                    ]
                );
              
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
                            'message' => 'vous n\'etes pas autorizé a editer cette donnée'
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
        $delete = Detailfp::find($id);

        if ($delete) { 
            if (Auth::user()->id == $delete->user_id) {
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
                        'status' => 442,
                        'message' => 'vous n\'etes pas autorisé a effectué cette action'
                    ],
                    422
                );
            }
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
        // ce bout de code nous permet de restorer les données supprimées referencié par un id
        $restore = Detailfp::withTrashed()->find($id);
        if ($restore && $restore->trashed()) {
            $restore->restore();

            return response()->json([
                'status' => 200,
                'message' =>
                'felicitation vous avez restoré un enregistrement'
            ], 200);
        } else {
            if (isset($restore->id)) {
                return response()->json([
                    'status' => 500,
                    'message' => 'cette donnée a été déja restorée'
                ], 500);
            }
            return response()->json([
                'status' => 404,
                'message' => 'cet id n\'existe pas'
            ], 404);
        }
    }
    /**
     * Summary of restores
     * @return void
     */
    public function restorerAll()
    {
        // ce bout de code nous permet de restorer toutes les données qui ont été supprimés
        $restores = Detailfp::onlyTrashed();


        if ($restores->count() > 0) {
            $restores->restore();

            return response()->json([
                'status' => 200,
                'message' => 'Felicitation vous avez recu a restoré toutes les données supprimés'
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
    
    public function search(Request $request)
    {  
       $query = Detailfp::query();
    //ce bout de code nous permet de faire une recherche automatique selon les colonnes que nous avons defini 
       if ($s = $request->input('search')) {
          $query->whereRaw("numero LIKE '%".$s."%'")
            ->orWhereRaw("Annee LIKE '%".$s."%'")
            ->orWhereRaw("CoNum LIKE '%".$s."%'");

           if($count = count($query->get())>0){
                return $query->get();
           } else {
              return response()->json(
              [
                'status'=>404,
                'message'=>'Desolé, nous n\'avons pas trouvé les données correspondants'
              ],404  
            );
           }
       }
       //filtrer selon la colonne serie /asc ou desc
       if ($sort = $request->input('sort')) {
           $query->orderBy('serie',$sort);
           return $query->get();
       }
    //    pagination 
       $perPage = 10;
       $page = request('page',default:1);
       $total = $query->count();
       $fetch = $query->offset(( $page-1)*$perPage)->limit($perPage)->get();
       
       return [
            'data'=>$fetch,
            'total'=>$total,
            'page'=>$page,
            'Derniere_page'=>ceil( $total/$perPage)
       ];
    }
}