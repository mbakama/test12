<?php

namespace App\Http\Controllers;

use App\Models\Docteur;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //  $patients = Patient::with('docteurs')->get();
        // return view('patients.index', compact('patients'));
        // $patients = Patient::join('docteurs','docteurs.id','=','patients.docteur_id')->get(
         
        // );
        // cette requete fecth les données de la table patient et docteur
        $patients = DB::table('patients')->join('docteurs','docteurs.id','=','patients.docteur_id')->
        select(
            'docteurs.nom as n','docteurs.prenom as p','docteurs.id as id_d','patients.*')
        ->paginate(10);
         return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('patients.envoyer');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $query = DB::table('docteurs')->get();
       
        foreach ($query as $t){
            $t->id;
        }

    
       

        // DB::table('patients')->create([
        //     'nom'=>$request->nom,
        //     'prenom'=>$request->prenom,
        //     'numero'=>$request->numero,
        //     'adresse'=>$request->adresse
        // ])
        $patient = new Patient;

        $patient->nom = $request->nom;
        $patient->prenom = $request->prenom;
        $patient->numero = $request->numero;
        $patient->adresse = $request->adresse;
        $patient->probleme = $request->probleme;
        $patient->docteur_id = $t->id;

        $patient->save();
        return back()->with('message','donnees enregistrées');
      
    }
    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {

        dd ($patient = Patient::with('docteurs'));
        // dd($patients = DB::table('patients')->find($patient));
        return view('Patients.voir', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        return view('Patients.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        $query = DB::table('docteurs')->get();
       
        foreach ($query as $t){
            $t->id;
        }

        $patient->nom = $request->nom;
        $patient->prenom = $request->prenom;
        $patient->numero = $request->numero;
        $patient->adresse = $request->adresse;
        $patient->probleme = $request->probleme;
        $patient->docteur_id = $t->id;

        $patient->update();
        return back()->with('message','donnees modifiées');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();

        return back()->with('message','vous avez supprimer un enregistrement');

    }
}
