<?php

namespace App\Http\Controllers;


use App\Http\Resources\DetailResource;
use App\Models\Detailfp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DetailfpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donnees = DB::table('detailfps')->get();

        if ($donnees->count() > 0) {
            return DetailResource::collection($donnees);
        } else {
            return response()->json(
                [
                    'status' => 404,
                    'message' => 'Aucune donnée disponible pour le momemt'
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
        $data = \Illuminate\Support\Facades\Validator::make(
            $request->all(),
            [
                'numero' => 'required',
                'CodeSource' => '',
                'MontantCreditFc' => 'required',
                'MontantCreditUSD' => 'required',
                'Promoteur' => '',
                'AdressPromoteur' => '',
                'observation' => '',
                'telephone' => '',
                'Annee' => 'required',
                'CoNum' => 'required',
                'DateCreation' => 'required',
                'Status' => 'required'
            ]
        );
        if ($data->fails()) {
            return response()->json(
                [
                    'status' => 404,
                    'message' => $data->messages()
                ],
                404
            );
        } else {
            //   $run = new Detailfp;
            $run = DB::table('detailfps')->insert(
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

            if ($run) {
                return response()->json(
                    [
                        'status' => 200,
                        'messsage' => 'données stockées avec success'
                    ],
                    200
                );
            } else {
                return response()->json(
                    [
                        'status' => 500,
                        'message' => 'il ya peut etre une erreur quelque pqrt dans le code'
                    ],
                    500
                );
            }

        }

    }

    /**
     * Display the specified resource.
     */
    public function show($detailfp)
    {
        $data = Detailfp::find($detailfp);

        if ($data) {
            return response()->json(
                [
                    'status' => 201,
                    'detailfp' => $data,
                ],
                201
            );
        } else {
            return response()->json(
                [
                    'status' => 404,
                    'message' => 'cet id n\'existe pas',
                ],
                404
            );

        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $detailfp)
    {
        $data = \Illuminate\Support\Facades\Validator::make(
            $request->all(),
            [
                'numero' => 'required',
                'CodeSource' => '',
                'MontantCreditFc' => 'required',
                'MontantCreditUSD' => 'required',
                'Promoteur' => '',
                'AdressPromoteur' => '',
                'observation' => '',
                'telephone' => '',
                'Annee' => 'required',
                'CoNum' => 'required',
                'DateCreation' => 'required',
                'Status' => 'required'
            ]
        );
        if ($data->fails()) {
            return response()->json(
                [
                    'status' => 404,
                    'message' => $data->messages()
                ],
                404
            );
        } else {
            $run = Detailfp::find($detailfp)->update(
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

            if ($run) {
                return response()->json(
                    [
                        'status' => 201,
                        'messsage' => 'données modifié avec success'
                    ],
                    201
                );
            } else {
                return response()->json(
                    [
                        'status' => 500,
                        'message' => 'il ya peut etre une erreur quelque pqrt dans le code'
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
        $data = Detailfp::find($id);

        if ($data) {
            $data->delete();

            return response()->json(
                [
                    'status' => 201,
                    'messsage' => 'supprission reussi'
                ],
                201
            );
        } else {
            return response()->json(
                [
                    'status' => 500,
                    'message' => 'il ya peut etre une erreur quelque pqrt dans le code'
                ],
                500
            );
        }
    }

    public function restorer($detailfp)
    {
        $data = Detailfp::withTrashed()->find($detailfp);

        if ($data && $data->trashed()) {
            $data->restore();

            return response()->json([
                'status' => 201,
                'message' =>
                'felicitation vous avez restoré un enregistrement'
            ], 201);
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
        $restores = Detailfp::onlyTrashed();

        $restores->restore();

        if ($restores) {
            return response()->json([
                'status' => 201,
                'message' => 'toutes les données supprimées ont été restorées'
            ], 201);
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