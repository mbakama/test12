<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = DB::table('articles')->get();

        if ($articles->count()>0) {
            return response()->json(
                ['status'=>200,
                 'articles'=>$articles
            ],200
            );
        } else {
           return response()->json(
            ['status'=>442,
            'message'=>'pas des données disponible pour le moment'
           ],442
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
      
        $validate = Validator::make($request->all(),
        [
            'titre'=>'required',
            'contenu'=>'required'
        ]);

        if ($validate->fails()) {
            return response()->json(
                ['status'=> 422, 
                'message'=>$validate->messages()],422);
        } 
        // $articles = new Article;

        // $articles->titre = "je suis le titre";
        // $articles->contenu = "je suis le contenu";

        // $articles->save();
    }

    /**
     * Display the specified resource.
     */
    public function show($article)
    {
      
            $article = Article::find($article);
            if ($article) {
                    return response()->json(
                        ['status' => 200,
                        'article'=>$article
                        ],200); 
                    } else {
                            
                        return response()->json(
                            ['status' => 404,
                            'message'=>'cet identifiant nexiste pas'
                            ],404);
                        }
       
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($article)
    {
        $article = Article::find($article);
        if ($article) {
                return response()->json(
                    ['status' => 200,
                    'article'=>$article
                    ],200); 
                } else {
                        
                    return response()->json(
                        ['status' => 404,
                        'message'=>'cet identifiant nexiste pas'
                        ],404);
                    }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $valeurs = Validator::make($request->all(),
        ['titre'=>'required','contenu'=>'required']);

        if ($valeurs->fails()) {
            return response()->json(['status'=>402, 'message'=>$valeurs->messages()], 402);
        } else {
            try {
                $article->update(['titre'=>$request->titre,'contenu'=>$request->contenu]);

                return response()->json(['status'=>200, 'message'=>'données modifiées'], 200);
            } catch (Exception $e){
                return response()->json(['status'=>501, 'message'=>'erreurs'], 501);
            }
       
                 
           
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($article)
    {
        $article = Article::find($article);
        if ($article) {
               $article->delete();
                return response()->json(
                    ['status' => 200,
                    'article'=>'données supprimée avec success'
                    ],200); 
                } else {
                        
                    return response()->json(
                        ['status' => 404,
                        'message'=>'cet identifiant nexiste pas'
                        ],404);
                    }
    }
}
