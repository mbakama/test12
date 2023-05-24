<?php

namespace App\Http\Controllers;


use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $all = Test::paginate(5);

        // return json_encode([
        //     "data"=>$all
        // ]);
   
        $query = Test::query(); 
        if ($s = request('search')) {
            $query->whereRaw("description LIKE '%" . $s . "%'"); 
            if ($query->count() > 0) {
                return [
                    "nombre de données trouver" => count($query->get()),
                    "Donnees trouvées" => $query->get() 
                ] ;
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
        $sort = request('sort', 'asc');

        if ($sort == "asc") {
            $all = Test::orderBy('id', $sort)->get();

            if ($all->count() > 0) {
                return [
                    "Nombres des donnees trouvées" => count($all),
                    "Data" => Test::collection($all)->paginate(5)
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
        } elseif ($sort == "desc") {
        
            $all = DB::table('tests')->orderBy('id', $sort)->get();

            if (count($all) > 0) {
                return [
                    "Nombres des données trouvées" => count($all),
                    "Data" => $all->paginate(5)
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
        } else {
            return response()->json(
                [
                    'status' => 404,
                    'message' => 'Desolé ! Seuls les arguments \'asc\' et \'desc\' sont autorisés'
                ],
                404
            );

        }

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
        $validation = Validator::make($request->all(),
        [
            "description"=>"required"
        ]);

        if ($validation->fails()) {
           return json_encode(
            [
                "status"=>404,
                "messages"=>$validation->messages()
            ]
            );
        }

        
    }

    /**
     * Display the specified resource.
     */
    public function show(Test $test)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Test $test)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Test $test)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Test $test)
    {
        //
    }
}
