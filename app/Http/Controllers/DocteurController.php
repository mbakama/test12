<?php

namespace App\Http\Controllers;

use App\Models\Docteur;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocteurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::paginate(10);
        return view('docteurs.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Docteur $docteur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Docteur $docteur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Docteur $docteur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Docteur $docteur)
    {
        //
    }
    public function repondre($id)
    {
        $all = Patient::find($id);
        return view('docteurs.repondre', compact('all'));
    }
    public function reponse(Request $request, Patient $id)
    {
        $query = DB::table('docteurs')->get();
       
        foreach ($query as $t){
            $t->id;
        }

        $id->nom = $request->nom;
        $id->prenom = $request->prenom;
        $id->numero = $request->numero;
        $id->adresse = $request->adresse;
        $id->probleme = $request->probleme;
        $id->docteur_id = $t->id;
      $id->reponse = $request->reponse; 

        $id->update();
        return back()->with('message','donnees modifiées');
    }
}
