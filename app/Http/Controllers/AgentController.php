<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $agents = Agent::all();

        // return view('agents.index', compact('agents'));

        if ($agents->count()>0) {
            return response()->json(
                [
                    'statut'=>200,
                    'agents'=>$agents
                ], 200
            );
        }
        return response()->json(
            [
                'statut'=>404,
                'message'=>'no records'
            ], 404
        );
    }
    public function restore()
    {
        $agents = Agent::onlyTrashed()->get();

        return view('agents.archive', compact('agents'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('agents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // DB::table('agents')->insert(
        //     ['nom'=>$request->nom,
        //     'prenom'=>$request->prenom,
        //     'email'=>$request->email,
        //     'numero'=>$request->numero,
        //     'adresse'=>$request->adresse,
        //     'sexe'=>$request->sexe,
        //     'etat'=>$request->etat]
        // );

        $val = Validator::make($request->all(),
            [
                'nom'=>'required',
                'prenom'=>'required',
                'email'=>'required',
                'numero'=>'required',
                'adresse'=>'required',
                'sexe'=>'required',
                'etat'=>'required'
            ]
            );

            if ($val->fails()) {
                return response()->json(
                    [
                        'statut'=>422,
                        'errors'=>$val->messages()
                    ], 422
                );
            } else{
                $agent = Agent::create(
                    [
                        'nom'=>$request->nom,
                        'prenom'=>$request->prenom,
                        'email'=>$request->email,
                        'numero'=>$request->numero,
                        'adresse'=>$request->adresse,
                        'sexe'=>$request->sexe,
                        'etat'=>$request->etat
                    ]
                    );
                if ($agent) {
                    return response()->json(
                        [
                            'statut'=>200,
                            'message'=>'données enregistrés'
                        ], 200
                    );
                } else {
                    return response()->json(
                        [
                            'statut'=>500,
                            'errors'=>'erreurs'
                        ], 500
                    );
                }
            }
        // $post = new Agent;

        // $post->nom = $request->nom;
        // $post->prenom = $request->prenom;
        // $post->email = $request->email;
        // $post->numero = $request->numero;
        // $post->adresse = $request->adresse;
        // $post->sexe = $request->sexe;
        // $post->etat = $request->etat;

        // $post->save();
        // return back()->with('message','données enregistrées avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $agent = Agent::find($id);

        if ($agent) {
            return response()->json(
                [
                    'statut'=>200,
                    'agent'=>$agent
                ], 404
            );
        } else {
            return response()->json(
                [
                    'statut'=>404,
                    'errors'=>'aucune donnee'
                ], 404
            );
        }
      
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $agent = Agent::find($id);

        if ($agent) {
            return response()->json(
                [
                    'statut'=>200,
                    'agent'=>$agent
                ], 200
            );
        } else {
            return response()->json(
                [
                    'statut'=>404,
                    'errors'=>'aucune donnee'
                ], 404
            );
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        // $agent->nom = $request->nom;
        // $agent->prenom = $request->prenom;
        // $agent->email = $request->email;
        // $agent->numero = $request->numero;
        // $agent->adresse = $request->adresse;
        // $agent->sexe = $request->sexe;
        // $agent->etat = $request->etat;
        
        $val = Validator::make($request->all(),
            [
                'nom'=>'required',
                'prenom'=>'required',
                'email'=>'required',
                'numero'=>'required',
                'adresse'=>'required',
                'sexe'=>'required',
                'etat'=>'required'
            ]
            );

            if ($val->fails()) {
                return response()->json(
                    [
                        'statut'=>422,
                        'errors'=>$val->messages()
                    ], 422
                );
            } else{
                $agent = Agent::find($id);
                if ($agent) {
                    $agent->update(
                        [
                            'nom'=>$request->nom,
                            'prenom'=>$request->prenom,
                            'email'=>$request->email,
                            'numero'=>$request->numero,
                            'adresse'=>$request->adresse,
                            'sexe'=>$request->sexe,
                            'etat'=>$request->etat
                        ]
                        );
                    return response()->json(
                        [
                            'statut'=>200,
                            'message'=>'données modifiées'
                        ], 200
                    );
                } else {
                    return response()->json(
                        [
                            'statut'=>500,
                            'errors'=>'erreurs'
                        ], 500
                    );
                }
            }

        // $agent->update([
        //     'nom'=>$request->nom,
        //     'prenom'=>$request->prenom,
        //     'email'=>$request->email,
        //     'numero'=>$request->numero,
        //     'adresse'=>$request->adresse,
        //     'sexe'=>$request->sexe,
        //     'etat'=>$request->etat
        // ]);

        // return back()->with('message','données modifiées avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $agent = Agent::find($id);
      
        if ($agent) {
            $agent->delete();
            return response()->json(
                [
                    'statut'=>200,
                    'message'=>'info supprimé'
                ], 200
            );
        } else {
            return response()->json(
                [
                    'statut'=>404,
                    'errors'=>'erreur'
                ], 404
            );
        }
       
        // $agent->delete();

        // return back()->with('message','Vous avez supprimer un enregistrement');
    }

    
    public function restored($id)
    {
        // $res = Agent::all()->find($id);
        // if ($res->trashed() && $res) {
        //    $res->restore();
        // }
        $resagents = Agent::withTrashed()->find($id);

        if ($resagents && $resagents->trashed()) {
            $resagents->restore();
        }
        return back();
    }
}
