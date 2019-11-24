<?php

namespace App\Http\Controllers\administration;

use App\Article;
use App\Http\Controllers\Controller;

use App\Commentaire;
use Illuminate\Http\Request;
use Validator;

class CommentaireController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('statutUser');
        $this->middleware('ajoutArticle');
        $this->middleware('checkAdministrateur');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $article = Article::where('slug',$slug)->first();
        if (!$article) {
            return redirect('404');
        }

        $data['commentaires'] = Commentaire::where('article_id',$article->id)->get();

        return view('administration.articles.commentaire.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function show(Commentaire $commentaire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function edit(Commentaire $commentaire)
    {
        return view('administration.articles.commentaire.edit', compact('commentaire'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commentaire $commentaire)
    {
        $validator = Validator::make($request->all(), [
            'contenu' => 'required|min:2|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all);
        }
        if ($request->isMethod('put')) {
            $valide = $request->input('valide');
            
            if($valide == null){
                $commentaire->valide = false;
            }else{
                $commentaire->valide = true;
            }
        
            $commentaire->contenu = $request->contenu;
            $commentaire->update();
        }
        
        return redirect()->route('commentaire.index',$commentaire->article->slug)->with('success', 'Modification effectuée');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $commentaire = Commentaire::find($id);
        if (!$commentaire) {
            return redirect('404');
        }

        $commentaire->delete();
        return redirect()->route('commentaire.index',$commentaire->article->slug)->with('success', 'Suppression effectuée');
    }

    public function valider($slug){
        $commentaire = Commentaire::where('slug',$slug)->first();
        if(!$commentaire){
           return redirect('404');
        }

        if($commentaire->valide == false){
            $commentaire->valide = true;
            $commentaire->update();
            return redirect()->back()->with('success', 'Opération effectuée avec succès');
        }else{
            $commentaire->valide = false;
            $commentaire->publish = false;
            $commentaire->update();
            return redirect()->back()->with('success', 'Opération effectuée avec succès');
        }
    }
    public function publier($slug){
        $commentaire = Commentaire::where('slug',$slug)->first();
        if(!$commentaire){
           return redirect('404');
        }
        
        if($commentaire->publish == false){
            $commentaire->publish = true;
            $commentaire->update();
            return redirect()->back()->with('success', 'Opération effectuée avec succès');
        }else{
            $commentaire->publish = false;
            $commentaire->update();
            return redirect()->back()->with('success', 'Opération effectuée avec succès');
        }
    }
}
