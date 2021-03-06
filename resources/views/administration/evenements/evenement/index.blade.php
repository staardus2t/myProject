@extends('layouts.app_administration')
@section('content')
<!-- BEGIN: Subheader -->
<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">Liste des Evenements</h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="#" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>


                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="" class="m-nav__link">
                        <span class="m-nav__link-text">Evénement</span>
                    </a>
                </li>
                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="" class="m-nav__link">
                        <span class="m-nav__link-text">Liste des evenements</span>
                    </a>
                </li>
            </ul>
        </div>

    </div>
</div>

<!-- END: Subheader -->
<div class="m-content">
        @include('shared.errors_succes')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <!-- <h3 class="m-portlet__head-text">
                                    Liste des clients
                                </h3> -->
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        <a href="{{ route('evenement.create') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                            <span>
                                <i class="la la-plus-circle"></i>
                                <span>Ajouter événement</span>
                            </span>
                        </a>
                    </li>
                    <li class="m-portlet__nav-item"></li>

                </ul>
            </div>
        </div>
        <div class="m-portlet__body">

            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable" id="list_items">
                <thead>
                    <th>Image</th>
                    <th>Titre</th>
                    <th>Catégorie</th>
                    <th>Lieu</th>
                    <th>Adresse</th>
                    <th>Site</th>
                    <th>Date</th>
                    <th>Validé</th>
                    @if(Auth::user()->role == 'Administrateur')
                    <th>Publié</th>
                    @endif
                    <th>Ajouté par</th>
                    <th>Date de création</th>
                    <th>Date de modification</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach ($evenements as $evenement)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/uploads/images/'.$evenement->image) }}" alt="" style="width:100px">
                        </td>
                        <td>
                            {{ $evenement->titre }}
                        </td>
                        <td>
                            {{ $evenement->categorie->nom }}
                        </td>
                        <td>
                            {{ $evenement->lieu }}
                        </td>
                        <td>
                            {{ $evenement->adresse }}
                        </td>
                        <td>
                            {{ $evenement->site }}
                        </td>
                        <td>
                            {{ $evenement->date }}
                        </td>
                        <td>
                            <span class="m-badge m-badge--{{ $evenement->valide ? 'success' : 'danger'}} m-badge--wide">{{ $evenement->valide ? 'oui' : 'non' }}</span>
                        </td>
                        @if(Auth::user()->role == 'Administrateur')
                        <td>
                            <span class="m-badge m-badge--{{ $evenement->publish ? 'success' : 'danger'}} m-badge--wide">{{ $evenement->publish ? 'oui' : 'non' }}</span>
                        </td>
                        @endif
                        <td>
                            {{ $evenement->user->name }}
                        </td>
                        <td>
                            {{ $evenement->created_at }}
                        </td>
                        <td>
                            {{ $evenement->updated_at }}
                        </td>
                        <td style="text-align:center;">
                            @if(Auth::user()->role == 'Contributeur' && $evenement->valide == true)
                            -
                            @else
                            <span class="dropdown">
                                <a href="#" class="btn m-btn btn-accent m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="la la-ellipsis-h"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end"
                                    style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-32px, 27px, 0px);">
                                    @if(Auth::user()->role == 'Administrateur')
                                        <a class="dropdown-item" href="{{route('evenement.show',$evenement->slug)}}" >
                                            <i class="la la-eye"></i> &nbsp; Voir l'événement
                                        </a>
                                        <a class="dropdown-item" href="{{route('evenement.valider',$evenement->slug)}}" 
                                            onclick="return confirm('Confirmer cette action ?');">
                                            <i class="la la-edit"></i> &nbsp; {{ $evenement->valide ? 'Annuler validation' : 'Valider'}}
                                        </a>
                                        @if($evenement->valide)
                                        <a class="dropdown-item" href="{{route('evenement.publier',$evenement->slug)}}" 
                                            onclick="return confirm('Confirmer cette action ?');">
                                            <i class="la la-edit"></i> &nbsp; {{ $evenement->publish ? 'Annuler publication' : 'Publier'}}
                                        </a>
                                        @endif
                                    @endif
                                    <a class="dropdown-item" href="{{route('evenement.edit',$evenement->slug)}}">
                                        <i class="la la-edit"></i> &nbsp; Modifer
                                    </a>
                                    
                                    <form action="{{ route('evenement.destroy', $evenement->slug)}}" method="POST" id="formDelete">
                                        @csrf
                                        @method('DELETE')
                                        <button class="dropdown-item" onclick="return confirm('Confirmer cette action ?');" type="submit">
                                            <i class="la la-close"></i> &nbsp; Supprimer
                                        </button>
                                    </form>
                                </div>
                            </span>
                            @endif
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    <!-- END EXAMPLE TABLE PORTLET-->
</div>

@section('datatable')
<script>
		$("#list_items").dataTable({
			"order": [
				[1, "desc"]
			],
			"language": {
					"sProcessing": "Traitement en cours ...",
					"sLengthMenu": "Afficher _MENU_ lignes",
					"sZeroRecords": "Aucun résultat trouvé",
					"sEmptyTable": "Aucune donnée disponible",
					"sInfo": "Lignes _START_ à _END_ sur _TOTAL_",
					"sInfoEmpty": "Aucune ligne affichée",
					"sInfoFiltered": "(Filtrer un maximum de_MAX_)",
					"sInfoPostFix": "",
					"sSearch": "Chercher:",
					"sUrl": "",
					"sInfoThousands": ",",
					"sLoadingRecords": "Chargement...",
					"oPaginate": {
						"sFirst": "<<", "sLast": ">>", "sNext": ">", "sPrevious": "<"
					},
					"oAria": {
						"sSortAscending": ": Trier par ordre croissant", "sSortDescending": ": Trier par ordre décroissant"
					}
					}
			});

			$.fn.datepicker.dates['fr'] = {
			days: ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"],
			daysShort: ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"],
			daysMin: ["Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa"],
			months: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"],
			monthsShort: ["Jan", "Fév", "Mar", "Avr", "Mai", "Jui", "Jui", "Aou", "Sep", "Oct", "Nov", "Dec"],
			today: "Aujourd'hui",
			clear: "Vider",
			format: "dd-mm-yyyy",
			titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
			weekStart: 0
		};


	</script>
@endsection

<script>
    var li  = document.getElementById('evenement');
    li.setAttribute('class', 'm-menu__item m-menu__item--submenu m-menu__item--open');

    var active  = document.getElementById('index_evenement');
    active.setAttribute('class', 'm-menu__item m-menu__item--active');
</script>
@endsection