<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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

        if ($articles->count() > 0) {
            return response()->json(
                [
                    'status' => 200,
                    'articles' => $articles
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => 442,
                    'message' => 'pas des données disponible pour le moment'
                ],
                442
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

        // $validate = Validator::make($request->all(),
        // [
        //     'titre'=>'required',
        //     'contenu'=>'required'
        // ]);

        // if ($validate->fails()) {
        //     return response()->json(
        //         ['status'=> 422, 
        //         'message'=>$validate->messages()],422);
        // } else {


        //   var_dump($article = Article::create(
        //         [
        //             'titre'=>$request->titre,
        //             'contenu'=>$request->contenu,
        //             'user_id' =>Auth::user()->id
        //         ]
        //         ));
        // if ($article) {
        //     return response()->json(
        //         [
        //             'statut'=>200,
        //             'message'=>'données enregistrés'
        //         ], 200
        //     );
        // } else {
        //     return response()->json(
        //         [
        //             'statut'=>500,
        //             'errors'=>'erreurs'
        //         ], 500
        //     );
        // }

        $this->validate($request, ['titre' => 'required', 'contenu' => 'required']);

        $articles = new Article;

        $articles->titre = $request->titre;
        $articles->contenu = $request->contenu;
        $articles->user_id = Auth::user()->id;
        $articles->save();

        if ($articles) {
            return response()->json(
                [
                    'statut' => 200,
                    'message' => 'données enregistrés'
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'statut' => 500,
                    'errors' => 'erreurs'
                ],
                500
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($article)
    {
        //ici on recupere l'id de l'article a partir de la methode find
        $article = Article::find($article);
        //avec ce bout de code on verifie si la cle etrangere user_id se trouva dans la table article est egale a l'id du user connecte
        if ($article->user_id == Auth::user()->id) {
            //si oui on revoi la reponse avec les informations correspondantes
            if ($article) {
                return response()->json(
                    [
                        'status' => 200,
                        'article' => $article
                    ],
                    200
                );
            } else {
                //si on affiche le message d'erreur dans le cas ou l'id demande nexiste pas
                return response()->json(
                    [
                        'status' => 404,
                        'message' => 'cet identifiant nexiste pas'
                    ],
                    404
                );
            }
        } else {
            //sinon on affiche le message d'avetissement pour indiquer que le user ne pas connecter
            return response()->json(
                [
                    'status' => 404,
                    'message' => 'tu ne peux pas voir cet article car tu nas pas lautorisation'
                ],
                404
            );
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($article)
    {
        $article = Article::find($article);
        if ($article->user_id == Auth::user()->id) {
            if ($article) {
                return response()->json(
                    [
                        'status' => 200,
                        'article' => $article
                    ],
                    200
                );
            } else {

                return response()->json(
                    [
                        'status' => 404,
                        'message' => 'cet identifiant nexiste pas'
                    ],
                    404
                );
            }
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {

        $this->validate($request, ['titre' => 'required', 'contenu' => 'required']);
        if ($article->user_id == Auth::user()->id) {
            $article->titre = $request->titre;
            $article->contenu = $request->contenu;
            $article->user_id = Auth::user()->id;
            $article->update();

            if ($article) {
                return response()->json(['status' => 200, 'message' => 'données modifiés'], 200);
            } else {
                return response()->json(['status' => 404, 'message' => 'erreurs'], 404);
            }
        } else {
            return response()->json(['status' => 404, 'message' => 'vous netez pas autorisé a modifé cet article']);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($article)
    {
        $article = Article::findOrFail($article);
        if ($article) {
            $article->delete();
            return response()->json(
                [
                    'status' => 200,
                    'article' => 'données supprimée avec success'
                ],
                200
            );
        } else {

            return response()->json(
                [
                    'status' => 404,
                    'message' => 'cet identifiant nexiste pas'
                ],
                404
            );
        }
    }

    public function restore($article)
    {
        $rest = Article::withTrashed()->find($article);

        if ($rest && $rest->trashed()) {
            $rest->restore();
        }
    }
}