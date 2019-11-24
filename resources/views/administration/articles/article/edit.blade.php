@extends('layouts.app_administration')
@section('content')
<!-- BEGIN: Subheader -->
<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="#" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="" class="m-nav__link">
                        <span class="m-nav__link-text">Tableau de bord</span>
                    </a>
                </li>
                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="" class="m-nav__link">
                        <span class="m-nav__link-text">Article</span>
                    </a>
                </li>
                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="" class="m-nav__link">
                        <span class="m-nav__link-text">Modifier article</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- END: Subheader -->
<div class="m-content">
    @include('shared.errors_succes')
    <div class="row">
        <div class="col-lg-12">
        
            <form class="m-form m-form--label-align-left- m-form--state-" id="m_form"
                action="{{route('article.update',$article->slug)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!--begin::Portlet-->
                <div class="m-portlet m-portlet--last m-portlet--head-lg m-portlet--responsive-mobile"
                    id="main_portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-progress">

                            <!-- here can place a progress bar-->
                        </div>
                        <div class="m-portlet__head-wrapper">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Modifier Article
                                    </h3>
                                </div>
                            </div>
                            <div class="m-portlet__head-tools">
                                <div class="btn-group">
                                    <button type="submit"
                                        class="btn btn-accent  m-btn m-btn--icon m-btn--wide m-btn--md">
                                        <span>
                                            <i class="la la-check"></i>
                                            <span>Enregistrer</span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <!--begin: Form Body -->
                        <div class="m-portlet__body">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="m-form__section m-form__section--first">
                                        <div class="form-group m-form__group row">
                                            <label class="col-xl-2 col-lg-2 col-form-label">* Titre :</label>
                                            <div class="col-xl-10 col-lg-10">
                                                <input class="form-control m-input" type="text" name="titre" dir="rtl"
                                                    value="{{ $article->titre }}">
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label class="col-xl-2 col-lg-2 col-form-label">* Contenu :</label>
                                            <div class="col-xl-10 col-lg-10">
                                                <textarea name="contenu" class="form-control" dir="rtl"
                                                    id="editor">{{ $article->contenu }}</textarea>

                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label class="col-xl-2 col-lg-2 col-form-label">* Auteur :</label>
                                            <div class="col-xl-10 col-lg-10">
                                                <input class="form-control m-input" type="text" name="auteur" dir="rtl"
                                                    value="{{ $article->auteur }}">
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label class="col-xl-2 col-lg-2 col-form-label">* Catégorie :</label>
                                            <div class="col-xl-10 col-lg-10">
                                                <select class="form-control m-input m_selectpicker" name="categorie"
                                                    data-live-search="true" title="">
                                            <option value="{{ $article->categorie_id }}">{{ $article->categorie->nom }}</option>
                                                    @foreach ($categories as $categorie)
                                                    <option value="{{$categorie->id}}">{{ $categorie->nom }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label class="col-form-label col-lg-2 col-sm-12">* Date :</label>
                                            <div class="col-lg-3 col-md-9 col-sm-12">
                                                <div class="input-group date">
                                                    <input name="date" type="text" class="form-control m-input" readonly
                                                placeholder="" id="m_datepicker_2" value="{{ date('d-m-Y',strtotime($article->date)) }}" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="la la-calendar-check-o"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-separator m-separator--dashed m-separator--lg"></div>
                                    <div class="m-form__section">
                                        @if($article->image == NULL)
                                        <div class="form-group m-form__group">
                                            <label for="exampleInputEmail1">Image *</label>
                                            <div></div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile"
                                                    name="image">
                                                <label class="custom-file-label" for="customFile">Séléctionner une
                                                    image</label>
                                            </div>
                                        </div>
                                        @endif
                                        @if($article->fichier == NULL)
                                        <div class="form-group m-form__group">
                                            <label for="exampleInputEmail1">Fichier</label>
                                            <div></div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile"
                                                    name="fichier">
                                                <label class="custom-file-label" for="customFile">Séléctionner une
                                                    image</label>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!--end::Portlet-->
        </div>
    </div>
    
    <div class="row" style="margin-top:20px">
        <div class="col-lg-12">

            <!--begin::Portlet-->
            <div class="m-portlet">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Image
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">

                    <!--begin::Section-->
                    <div class="m-section m-section--last">
                        <div class="m-section__content">

                            <!--begin::Preview-->
                                @if($article->image != NULL)
                                <div class="m-demo__preview"  style="margin-bottom:10px">
                                    <img src="{{asset('storage/uploads/images/'.$article->image)}}"
                                        style="max-width:350px" alt="">
                                </div>
                                <div class="btn-group">
                                    <a href="{{ route('article.supprimer_image', $article->slug)}}" class="btn btn-danger"
                                        onclick="return confirm('Confirmer cette action ?');">Supprimer
                                    </a>
                                </div>
                                @else
                                Aucune image
                                @endif
                        </div>
                    </div>

                    <!--end::Section-->
                </div>
            </div>

            <div class="m-portlet">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Fichier
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">

                    <!--begin::Section-->
                    <div class="m-section m-section--last">
                        <div class="m-section__content">

                            <!--begin::Preview-->
                                @if($article->fichier != NULL)
                                <div class="m-demo__preview">
                                    <a href="{{asset('storage/uploads/fichiers_article/'.$article->fichier)}}"
                                        target="_blank"
                                        class="btn btn-warning m-btn m-btn--custom  m-btn--icon m-btn--air">
                                </div>
                                <div class="btn-group">
                                    <a href="{{ route('article.supprimer_fichier', $article->slug)}}" 
                                        class="btn btn-danger" onclick="return confirm('Confirmer cette action ?');">Supprimer
                                    </a>
                                </div>
                                @else
                                Aucun fichier
                                @endif
                        </div>
                    </div>

                    <!--end::Section-->
                </div>
            </div>

            <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Slider
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
    
                        <!--begin::Section-->
                        <div class="m-section m-section--last">
                            
                            @if(Empty($article->slider))
{{-- //////////////////////////Ajouter au slider//////////////////////// --}}
                            <div class="m-section__content">
                                <!--begin::Preview-->
                                    <form class="m-form m-form--label-align-left- m-form--state-" id="m_form"
                                        action="{{route('article.slider',$article->slug)}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="m-form__section m-form__section--first">
                                            <div class="form-group m-form__group row">
                                                <label class="col-xl-2 col-lg-2 col-form-label">* Ordre :</label>
                                                <div class="col-xl-4 col-lg-4">
                                                    <input class="form-control m-input" type="text" name="ordre">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="btn-group">
                                                <button type="submit"
                                                    class="btn btn-accent  m-btn m-btn--icon m-btn--wide m-btn--md">
                                                    <span>
                                                        <i class="la la-check"></i>
                                                        <span>Ajouter au slider</span>
                                                    </span>
                                                </button>
                                            </div>
                                    </form>
                            </div>
                            @else
{{-- //////////////////////////Supprimer du slider//////////////////////// --}}
                            <div class="m-section__content">
                                <!--begin::Preview-->
                                    <form class="m-form m-form--label-align-left- m-form--state-" id="m_form"
                                        action="{{route('article.supprimer_slider',$article->slug)}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('DELETE')
                                        <div class="btn-group">
                                                <button type="submit"
                                                    class="btn btn-danger  m-btn m-btn--icon m-btn--wide m-btn--md">
                                                    <span>
                                                        
                                                        <span>Enlever du slider</span>
                                                    </span>
                                                </button>
                                            </div>
                                    </form>
                            </div>
                            @endif
                            
                        </div>
    
                        <!--end::Section-->
                    </div>
                </div>

            <!--end::Portlet-->
        </div>
    </div>
</div>
@section('ckeditor')
<script>
    // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace( 'editor' );
</script>
@endsection

<script>
    var li  = document.getElementById('article');
    li.setAttribute('class', 'm-menu__item m-menu__item--submenu m-menu__item--open');
</script>
@endsection