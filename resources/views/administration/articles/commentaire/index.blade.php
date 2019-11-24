@extends('layouts.app')
@section('content')
@include('shared.errors_succes')
<table>
    <thead>
        <th>Contenu</th>
        <th>Valide</th>
        <th>Date de création</th>
        <th>Date de modification</th>
        <th>Modifier</th>
        <th>Supprimer</th>
    </thead>
    <tbody>
        @foreach ($commentaires as $commentaire)
        <tr>
            <td>
                {{ $commentaire->contenu }}
            </td>
            <td>
                {{ $commentaire->valide ? 'Validé' : 'Non validé' }}
            </td>
            <td>
                {{ $commentaire->created_at }}
            </td>
            <td>
                {{ $commentaire->updated_at }}
            </td>
            <td>
                <a href="{{route('commentaire.edit',$commentaire->id)}}">Edit</a>
            </td>
            <td>
                <form action="{{ route('commentaire.destroy', $commentaire->id)}}" method="POST" id="formDelete">
                    @csrf
                    @method('DELETE')
                    <button class="dropdown-item" onclick="return confirm('Confirmer cette action ?');" type="submit">
                        <i class="la la-close"></i> &nbsp; Supprimer
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
       
    </tbody>
</table>

@endsection