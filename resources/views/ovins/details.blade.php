@extends('layouts.menu')
@section('title')
    <title>التفاصيل </title>
@endsection
@section('contenu')
    <div class="container">

        <div class="row">
            <div class="row">
                <label for="num">الرقم : </label>
                <input type="text" class="form-control" name="num" value="{{ $ovin->num }}" readonly='readonly'>
            </div>
            <div class="col">
                <label for="date_achat">تاريخ الشراء : </label>
                <input type="date" class="form-control" name="date_achat" value="{{ $ovin->date_achat }}"
                    readonly='readonly'>
            </div>
            <div class="col">
                <label for="date_vente">تاريخ البيع/الإعادة : </label>
                <input type="date" class="form-control" name="date_vente" value="{{ $date_vente }}"
                    readonly='readonly'>
            </div>
            <div class="col">
                <label for="date_naissance">تاريخ الميلاد : </label>
                <input type="date" class="form-control" name="date_naissance" value="{{ $ovin->date_naissance }}"
                    readonly='readonly'>
            </div>
            <div class="col">
                <label for="die_date">تاريخ النفوق : </label>
                <input type="date" class="form-control" name="die_date" value="{{ $ovin->die_date }}"
                    readonly='readonly'>
            </div>
        </div>
        <div class="row">

            <div class="col">

                <label for="sex"> الجنس : </label>
                <input type="text" class="form-control" name="sex" value="{{ $sex }}"readonly='readonly'>


            </div>
            <div class="col">
                <label for="age"> السن : </label>
                <input type="text" class="form-control" name="age" value="{{ $age }}" readonly='readonly'>
            </div>
            <div class="col">
                <label for="status"> الحالة : </label>
                <input type="text" class="form-control" name="status" value="{{ $status }}" readonly='readonly'>
            </div>
            <div class="col">
                <label for="poid">الوزن : </label>
                <input type="number" class="form-control" name="poid" value="{{ $ovin->poid }}"placeholder="الوزن"
                    readonly='readonly'>
            </div>
        </div>



    </div>
    @if ($ovin->sexe == 0)
        {

        @include('avorter.historique')
        @include('naissance.historique')
        }
    @endif



    <form action="{{ route('ovins.index') }}" method="post">
        @csrf
        {{ method_field('GET') }}
        <!-- @   method('GET');-->
        <div class="row">
            <button class="btn btn-primary" type="submit">الرجوع</button>
        </div>
    </form>
@endsection
