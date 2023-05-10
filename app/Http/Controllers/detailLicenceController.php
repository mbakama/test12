<?php

namespace App\Http\Controllers;

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
        $details = DB::table('detail_licences')->get();

        if ($details->count() > 0) {
            return response()->json(
                [
                    'status' => 200,
                    'details' => $details
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => 404,
                    'message' => 'pas des données disponibles'
                ],
                404
            );
        }

    }

    /**
     * Show the form for creating a new resource.
     */
  

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $detail = Validator::make(
           //
            $request->all(),
            [
                'CodeDetailLicence' => 'required',
                'serie' => 'required',
                'codeDouane' => 'required',
                'codePaysOrg' => 'required',
                'quantite' => 'required',
                'codeDevice' => 'required',
                'prixUnit' => 'required',
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
    public function show($detail)
    {
        $details = DetailLicence::find($detail);

        if ($details) {
            return response()->json([
                'statut' => 200,
                'detail' => $details
            ], 200);
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
                'CodeDetailLicence' => 'required',
                'serie' => 'required',
                'codeDouane' => 'required',
                'codePaysOrg' => 'required',
                'quantite' => 'required',
                'codeDevice' => 'required',
                'prixUnit' => 'required',
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
                            'status' => 200,
                            'message' => 'Vos données ont été modifiées avec success'
                        ],
                        200
                    );
                } else {
                    return response()->json(
                        [
                            'status' => 500,
                            'message' => 'vous n\'etes pas autorizé a editer ce poste'
                        ],
                        500
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
    public function destroy(int $delete)
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
    public function restores()
    {
        // ce bout de code nous permet de restorer toutes les données qui ont été supprimés
        $restores = DetailLicence::onlyTrashed();

        $restores->restore();

        if ($restores) {
            return response()->json([
                'status' => 200,
                'message' => 'toutes les données supprimés ont été restorées'
            ], 200);
        } else {

            return response()->json(
                [
                    'status' => 404,
                    'message' => 'rien a restoré'
                ],
                404
            );
        }

    }
}