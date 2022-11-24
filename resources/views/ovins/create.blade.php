
@extends('layouts.menu')
@section ('title')
<title>إضافة حيوان</title>
@endsection
@section ('contenu')
<h1>إضافة حيوان</h1>
{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}
<form action="{{route('ovins.store')}}" method="post">
    @csrf
     <div class="c100">
        <label for="numéro">Numéro : </label>
        <input type="number" id="num" name="num" maxlength = 20 minlength=1 class="@error('num') is-invalid @enderror" required value={{old('num')}}>
        @error('num')
           <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
       <div class="c100">
        <label for="date_achat">Date achat : </label>
        <input type="date" id="date_achat" name="date_achat" required class="@error('date_achat') is-invalid @enderror" value={{old('date_achat')}}>
    </div>
    <div class="c100">
        <label for="poid"> Le poids: </label>
        <input type="number" id="poid" name="poid" minlength=1 maxlength=3 value={{old('poid')}} >
    </div>

    <div class="c100">
        <input type="radio" id="Male" name="sexe" value="Male" >
        <label for="Male">Male</label>
        <input type="radio" id="Female" name="sexe" value="Female" checked>
        <label for="Female">Female</label>
    </div>

    <div class="c100" id="submit">
        <input type="submit" value="Ajouter">
    </div>
</form>
@endsection
@section ('sidebar')
@parent
<h1> poste side barre  </h1>
@endsection

