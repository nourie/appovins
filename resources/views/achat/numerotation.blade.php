@extends('layouts.menu')
@section('title')
    <title> ترقيم الحيوانات </title>
@endsection
@section('contenu')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <h1>ترقيم الحيوانات </h1>
    {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}
    <form action="{{ route('achat.numerotation') }}" method="post">
        @csrf
        {{ method_field('GET') }}
        <!-- @   method('PUT');-->
        <input id="id" name="id" type="hidden" value="{{ $achats->id }}">
        <div class="form-floating">
            <textarea class="form-control" name="text" placeholder="Leave a comment here" id="floatingTextarea2"
                style="height: 100px"></textarea>
            <label for="floatingTextarea2">إدخال الأرقام على الشكل 1 إلى 100 على الشكل 1-100</label>
        </div>
        <div class="c100">
            <label for="date_achat">تاريخ الشراء : </label>
            <input type="date" id="date_achat" name="date_achat" required max="{{ date('Y-m-d') }}" min="2022-01-01"
                class="@error('date_achat') is-invalid @enderror" value={{ $achats->date_achat }}>
        </div>
        <div class="c100">
            <label for="nb_male"> عدد الذكور: </label>
            <input type="number" id="nb_male" name="nb_male" min=0 minlength=1 maxlength=3 value={{ $achats->nb_male }}
                readonly="readonly">
        </div>
        <div class="c100">
            <label for="nb_female"> عدد الاناث: </label>
            <input type="number" id="nb_female" name="nb_female" min=0 minlength=1 maxlength=3
                value={{ $achats->nb_female }} readonly="readonly">
        </div>
        <div class="c100">
            <label for="nb_angeau"> عدد الخراف: </label>
            <input type="number" id="nb_angeau" name="nb_angeau" min=0 minlength=1 maxlength=3
                value={{ $achats->nb_agneau }} readonly="readonly">
        </div>
        <div id="submit">
            <input type="submit" value="إضافة">
        </div>
    </form>
@endsection
