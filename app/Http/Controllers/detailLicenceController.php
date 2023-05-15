<?php

namespace App\Http\Controllers;

use App\Http\Resources\DetailResource;
use Illuminate\Http\Request;
use App\Models\DetailLicence;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
 class detailLicenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $details = DetailLicence::all();

        if ($details->count() > 0) {
            return DetailResource::collection($details);
        } else {
            return response()->json(
                [
                    'status' => 204,
                    'message' => 'pas des données disponibles'
                ],
                204
            );
        }

    }
 /**
     * Summary of store
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $detail = Validator::make(
           //
            $request->all(),
            [
                'CodeDetailLicence' => 'required|numeric|min:5',
                'serie' => 'required|alpha_dash:ascii',
                'codeDouane' => 'required|numeric',
                'codePaysOrg' => 'required|numeric',
                'quantite' => 'required|numeric',
                'codeDevice' => 'required|numeric',
                'prixUnit' => 'required|numeric',
                'unitStat' => 'required',
                'DateSaisie' => 'required'
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
            $insert = DB::table('detail_licences')->insert(
                [
                    'CodeDetailLicence' => $request->CodeDetailLicence,
                    'serie' => $request->serie,
                    'codeDouane' => $request->codeDouane,
                    'codePaysOrg' => $request->codePaysOrg,
                    'quantite' => $request->quantite,
                    'codeDevice' => $request->codeDevice,
                    'prixUnit' => $request->prixUnit,
                    'unitStat' => $request->unitStat,
                    'DateSaisie' => $request->DateSaisie,
                    'user_id' => Auth::user()->id
                ]
            );

            if ($insert) {
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
        $details = DetailLicence::find($id);

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
     * Summary of update
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $id)
    {

        $detail = Validator::make(
            $request->all(),
            [
                'CodeDetailLicence' => 'required|numeric|min:5',
                'serie' => 'required|alpha_dash:ascii',
                'codeDouane' => 'required|numeric',
                'codePaysOrg' => 'required|numeric',
                'quantite' => 'required|numeric',
                'codeDevice' => 'required|numeric',
                'prixUnit' => 'required|numeric',
                'unitStat' => 'required',
                'DateSaisie' => 'required'
            ]
        );

        if ($detail->fails()) {
            return response()->json(
                [
                    'status' => 401,
                    'message' => $detail->messages()
                ],
                401
            );
        } else {
            $update = DetailLicence::find($id);

            if ($update) {
                if ($update->user_id == Auth::user()->id) {

                    $update->update(
                        [
                            'CodeDetailLicence' => $request->CodeDetailLicence,
                            'serie' => $request->serie,
                            'codeDouane' => $request->codeDouane,
                            'codePaysOrg' => $request->codePaysOrg,
                            'quantite' => $request->quantite,
                            'codeDevice' => $request->codeDevice,
                            'prixUnit' => $request->prixUnit,
                            'unitStat' => $request->unitStat,
                            'DateSaisie' => $request->DateSaisie
                        ]
                    );
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
                            'status' => 403,
                            'message' => 'vous n\'etes pas autorizé a editer ce poste'
                        ],
                        403
                    );
                }
            } else {
                return response()->json(
                    [
                        'stutus' => 404, 
                        'message' => 'cet id n\'existe pas'
                    ],404
                );
            }
        }
    }

   
    /**
     * Summary of destroy
     * @param mixed $delete
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($delete)
    {
        $detail = DetailLicence::find($delete);

        if ($detail) {
            if (Auth::user()->id == $detail->user_id) {
                $detail->delete();

                return response()->json(
                    [
                        'status' => 200,
                        'message' => 'donnée supprimée avec success '
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'status' => 403,
                        'message' => 'vous n\'etes pas autorisé a effectué cette action'
                    ],
                    403
                );
            }
        } else {
            return response()->json(
                [
                    'status' => 404,
                    'message' => 'cet id n\'existe pas ou a éte supprimé'
                ],
                404
            );
        }
    }

    /**
     * Summary of restore
     * @param mixed $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore($id)
    {
        // ce bout de code nous permet de restorer les données supprimées referencié par un id
        $restore = DetailLicence::withTrashed()->find($id);
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
                    'status' => 206,
                    'message' => 'cette donnée a été déja restorée'
                ], 206);
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
    public function restores()
    {
        // ce bout de code nous permet de restorer toutes les données qui ont été supprimés
        $restores = DetailLicence::onlyTrashed();


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

    /**
     * cette fonction return toutes les donnees mais celles qui sont effacées
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function all_data()
    {
        $query = DetailLicence::withTrashed()->get();

        if ($query) {
            return DetailResource::collection($query);
        } else {
            return response()->json(
                [
                    'status'=>404,
                    'message'=>'il y a une erreur'
                ]
            );
        }
    }
    /**
     * Summary of search
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Http\JsonResponse|array
     */
    public function search(Request $request)
    {  
       $query = DetailLicence::query();
    //ce bout de code nous permet de faire une recherche automatique selon les colonnes que nous avons defini 
       if ($s = $request->input('search')) {
          $query->whereRaw("CodeDetailLicence LIKE '%".$s."%'")
            ->orWhereRaw("serie LIKE '%".$s."%'")
            ->orWhereRaw("codeDouane LIKE '%".$s."%'");

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