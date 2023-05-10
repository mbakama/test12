<?php

namespace App\Http\Controllers;

use App\Http\Requests\DetailRequest;
use App\Http\Resources\DetailResource;
use App\Models\Detailfp;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FpiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fetch_data = Detailfp::all();

        if ($fetch_data->count()>0) {
            //ici on fait appel une ressouce que nous avons creer pour nous retourner facilement les infos sous format Json
            return DetailResource::collection($fetch_data);
        } else {
            return response()->json(
                [
                    'status'=>404,
                    'message'=>'il n\'y a pas des données dans la table'
                ],404
            );
        }
    } 

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $val = Validator::make($request->all(),
        [
            "numero"=>"required|numeric"
        ]
        ); 

        if ($val->fails()) {
            return response()->json(
                [
                    'status'=>404,
                    'message'=>$val->messages()
                ]
            );
        }

        // $request->validate(
        //     [
        //         "numero"=>"required|numeric", 
        //     ]
        //     );
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
                    'status' =>404,
                    'message'=>'l\'id n\'existe pas dans notre table'
                ],404
            );
        }
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $delete = Detailfp::find($id);

        if ($delete) {
            $delete->delete();

            return response()->json(
                [
                    'status'=>200,
                    'message'=>'Supprission effectuée'
                ],200
            );
        } else {
            return response()->json(
                [
                    'status'=>404,
                    'message'=>'l\'id que vous avez inseré n\'existe pas ou a été effacé'
                ],404
            );
        }
    }
}
