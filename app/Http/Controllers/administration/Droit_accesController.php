<?php

namespace App\Http\Controllers\administration;

use App\Categorie;
use App\Categorie_evenement;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Database\QueryException;
use Validator;
use Illuminate\Http\Request;

class Droit_accesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('statutUser');
        $this->middleware('checkAdministrateur');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $data['article_categories'] = Categorie::all();
        $data['evenement_categories'] = Categorie_evenement::all();
        $data['user'] = $user;
        
        $data['droit_acces_articles'] = $user->select('categorie_droit_acces.*','categories.*','categorie_droit_acces.created_at as date_creation','categorie_droit_acces.updated_at as date_modification')
            ->join('categorie_droit_acces', 'categorie_droit_acces.user_id', '=', 'users.id')
            ->join('categories', 'categories.id', '=', 'categorie_droit_acces.categorie_id')
            ->where('categorie_droit_acces.user_id',$user->id)
            ->get();

        $data['droit_acces_evenements'] = $user->select('categorie_evenement_droit_acces.*','categorie_evenements.*','categorie_evenement_droit_acces.created_at as date_creation','categorie_evenement_droit_acces.updated_at as date_modification')
            ->join('categorie_evenement_droit_acces', 'categorie_evenement_droit_acces.user_id', '=', 'users.id')
            ->join('categorie_evenements', 'categorie_evenements.id', '=', 'categorie_evenement_droit_acces.categorie_id')
            ->get();
        
        
        return view('administration.categorie_droit_acces.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function article_create(User $user)
    {
        $data['article_categories'] = Categorie::all();

        $data['user'] = $user;
        return view('administration.categorie_droit_acces.article_create',$data);
    }

    public function evenement_create(User $user)
    {
        $data['evenement_categories'] = Categorie_evenement::all();

        $data['user'] = $user;
        return view('administration.categorie_droit_acces.evenement_create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function article_store(Request $request,User $user)
    {
        $validator = Validator::make($request->all(), [
            'article_categorie' => 'required|array|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all);
        }
    
        try {
            $user->droit_acces()->attach($request->article_categorie);
            return redirect()->route('categorie_droit_acces.index',$user->id)->with('success', 'Enregistrement effectuée');
        } catch (QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                return redirect()->route('categorie_droit_acces.index',$user->id)->with('error', 'Cet utilisateur à déjà un droit d\'accès sur cette catégorie');
            }
        }
    }

    public function evenement_store(Request $request,User $user)
    {
        $validator = Validator::make($request->all(), [
            'evenement_categorie' => 'required|array|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->all);
        }
    
        try {
            $user->droit_acces_evenement()->attach($request->evenement_categorie);
            return redirect()->route('categorie_droit_acces.index',$user->id)->with('success', 'Enregistrement effectuée');
        } catch (QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                return redirect()->route('categorie_droit_acces.index',$user->id)->with('error', 'Cet utilisateur à déjà un droit d\'accès sur cette catégorie');
            }
        }

    }

    
    public function article_destroy(User $user,Categorie $categorie)
    {
        $user->droit_acces()->detach($categorie->id);

        return redirect()->route('categorie_droit_acces.index',$user->id)->with('success', 'Suppression effectuée');
    }

    public function evenement_destroy(User $user,Categorie_evenement $categorie)
    {
        $user->droit_acces_evenement()->detach($categorie->id);

        return redirect()->route('categorie_droit_acces.index',$user->id)->with('success', 'Suppression effectuée');
    }
}
