@extends('layouts.app')
@section('content')
@include('shared.errors_succes')
<div class="container">
    <form class="m-form m-form--fit m-form--label-align-right" action="{{route('article.store')}}" method="POST"  enctype="multipart/form-data">
        @csrf
        <div class="m-portlet__body">
            <div class="form-group m-form__group row">
                <label class="col-form-label col-lg-3 col-sm-12">Titre *</label>
                <div class="col-lg-4 col-md-9 col-sm-12">
                    <div class="m-typeahead">
                        <input class="form-control m-input" type="text" name="titre" value="{{ old('titre') }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="m-portlet__body">
            <div class="form-group m-form__group row">
                <label class="col-form-label col-lg-3 col-sm-12">Contenu *</label>
                <div class="col-lg-4 col-md-9 col-sm-12">
                    <div class="m-typeahead">
                        <input class="form-control m-input" type="text" name="contenu" value="{{ old('contenu') }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="m-portlet__body">
            <div class="form-group m-form__group row">
                <label class="col-form-label col-lg-3 col-sm-12">Auteur *</label>
                <div class="col-lg-4 col-md-9 col-sm-12">
                    <div class="m-typeahead">
                        <input class="form-control m-input" type="text" name="auteur" value="{{ old('auteur') }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group m-form__group row">
            <label class="col-form-label col-lg-3 col-sm-12">Catégorie *</label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <select class="form-control m-input m_selectpicker" name="categorie" data-live-search="true" title="">
                    <option value=""></option> 
                    @foreach ($categories as $categorie) 
                        <option value="{{$categorie->id}}">{{ $categorie->nom }}</option> 
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group m-form__group row">
            <label class="col-form-label col-lg-3 col-sm-12">Date *</label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <div class="input-group date">
                    <input type="date" class="form-control m-input"  id="datepicker" name="date" value="{{ old('date') }}" />
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="la la-calendar-check-o"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group m-form__group">
            <label for="exampleInputEmail1">Image *</label>
            <div></div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile" name="image">
                <label class="custom-file-label" for="customFile">Séléctionner une image</label>
            </div>
        </div>

        <div class="form-group m-form__group">
            <label for="exampleInputEmail1">Fichier</label>
            <div></div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile" name="fichier">
                <label class="custom-file-label" for="customFile">Séléctionner un fichier</label>
            </div>
        </div>

        <div class="m-portlet__foot m-portlet__foot--fit">
            <div class="row">
                <div class="col-lg-7 ml-lg-auto">
                    <button type="submit" class="btn btn-primary">Valider</button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
