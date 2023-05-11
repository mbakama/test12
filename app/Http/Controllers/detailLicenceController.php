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
    public function show($detail)
    {
        $details = DetailLicence::find($detail);

        if ($details) {
            return new DetailResource($details);
        } else {
            return response()->json([
                'statut' => 404,
                'message' => 'cet id n\'existe pas ou a été effacé'
            ], 404);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
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
                return response()->json(['stutus' => 404, 'message' => 'cet id n\'existe pas'],404);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
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
                    'message' => 'cet id n\'existe pas'
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
                'status' => 201,
                'message' =>
                'felicitation vous avez restoré un enregistrement'
            ], 201);
        } else {
            if (isset($restore->id)) {
                return response()->json([
                    'status' => 204,
                    'message' => 'cette donnée a été déja restorée'
                ], 204);
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
         // ce bout de code nous permet de restorer toutes les données qui ont été supprimés
         $restores = DetailLicence::onlyTrashed();


         if ($restores->count() > 0) {
             $restores->restore();
 
             return response()->json([
                 'status' => 200,
                 'message' => 'Felicitation vous avez recu a restoré toutes les données supprimées'
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
        // $detailLicence = $detailLicence->newQuery();

        //  if ($request->has('CodeDetailLicence')) {
        //     $detailLicence->where('CodeDetailLicence',$request->keyword); 
        // }
        // if ($request->has('serie')) {
            
        //     $detailLicence->where('serie',$request->keyword); 
        // }
        // // if ($request->has('CodeDetailLicence')) {
        // //     $detailLicence->where('CodeDetailLicence',$request->keyword); 
        // // }
        // return $detailLicence->get();
        // // if ($request->has('serie')) {
        // //     $detailLicence->where('serie',$request->input('serie'));
            
        // // } 

    //     if ($fetch) { 
    //         $fetch = DetailLicence::where('CodeDetailLicence','LIKE','%'.$keyword.'%')->get();
    //     if (!empty($fetch)) { 
    //             return response()->json($fetch); 
    //     }
    //   }
        
       $query = DetailLicence::query();

       if ($s = $request->input('s')) {
          $query->whereRaw("CodeDetailLicence LIKE '%".$s."%'")
            ->orWhereRaw("serie LIKE '%".$s."%'");
         
       }
       return $query->get();
    }
} 