@extends('layouts.menu')
@section ('title')
<title>  شراء الحيوانات  </title>

@endsection
@section ('contenu')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

<h1>شراء الحيوانات </h1>
{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}
<form action="{{route('achat.addachat')}}" method="post">
    @csrf
    {{ method_field('GET') }}
    <!-- @   method('PUT');-->
    <div class="c100">
        <label for="nombre_achat">العدد : </label>
        <input type="text" id="nombre_achat" name="nombre_achat" min=0 maxlength = 20
        minlength=1 class="@error('nombre_achat') is-invalid @enderror" required value={{old('nombre_achat')}}>
        @error('nombre_achat')
           <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
       <div class="c100">
        <label for="date_achat">تاريخ الشراء : </label>
        <input type="date" id="date_achat" name="date_achat" required max="{{date('Y-m-d')}}"
        min="2022-01-01" class="@error('date_achat') is-invalid @enderror" value={{old('date_achat')}}    >
    </div>
    <div class="c100">
        <label for="nb_male"> عدد الذكور: </label>
        <input type="number" id="nb_male" name="nb_male" min=0 minlength=1 maxlength=3 value={{old('nb_male')}} >
    </div>
    <div class="c100">
        <label for="nb_female"> عدد الاناث: </label>
        <input type="number" id="nb_female" name="nb_female" min=0 minlength=1 maxlength=3 value={{old('nb_female')}} >
    </div>
    <div class="c100">
        <label for="nb_angeau"> عدد الخراف: </label>
        <input type="number" id="nb_angeau" name="nb_angeau"  min=0 minlength=1 maxlength=3 value={{old('nb_angeau')}} >
    </div>
     <div class="c100">
        <label for="vendeur">البائع:</label>
        <select name="vendeur" id="vendeur">

          <optgroup label="---">
            @php
             $user = \App\Models\User::where('userrole',3)->get();
             @endphp
            @foreach ($user as $users)
            <option value="{{$users->id}}">{{$users->name}}</option>
            @endforeach
          </optgroup>
         </select>
    </div>
    <div class="c100">
        <label for="prix_achat"> الثمن: </label>
        <input type="number" id="prix_achat" name="prix_achat"  min=0  step="0.01" value={{old('prix_achat')}} >
    </div>

    <div class="c100" id="submit">
        <input type="submit" value="إضافة">
    </div>
</form>
@endsection

<div>
@guest
<div class="shrink-0 flex items-center">
    <a href="{{ route('dashboard') }}">
       يجب تسجيل الدخول
    </a>
</div>
@endguest
</div>

