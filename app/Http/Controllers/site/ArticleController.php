<?php

namespace App\Http\Controllers\site;

use App\Article;
use App\Categorie;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function article_all(){
        $data['articles'] = Article::orderBy('created_at','DESC')
            ->where('valide',true)
            ->where('publish',true)
            ->paginate(9);

        return view('site.article_all',$data);
    }

    public function article_categorie($slug){
        $categorie = Categorie::where('slug',$slug)
                    ->where('valide',true)
                    ->where('publish',true)               
                    ->first();
        if(!$categorie){
            return redirect('404');
        }

        $data['categorie'] = $categorie;
        $data['articles'] = Article::where('categorie_id',$categorie->id)
                            ->where('valide',true)
                            ->where('publish',true)
                            ->paginate(9);

        return view('site.article_categorie',$data);
    }

    public function article_show($slug){
        $article = Article::where('slug',$slug)
                    ->where('valide',true)
                    ->where('publish',true)
                    ->first();
        if(!$article){
            return redirect('404');
        }

        $data['articles'] = Article::where('categorie_id',$article->categorie_id)
                            ->where('valide',true)
                            ->where('publish',true)
                            ->where('id','!=',$article->id)->orderBy('created_at','DESC')->take(3)->get();
        $data['article'] = $article;
        

        return view('site.article_show',$data);
    }
}
