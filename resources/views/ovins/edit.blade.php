@extends('layouts.menu')
@section('title')
    <title>قائمة الميتة </title>
@endsection
@section('contenu')

    <div class="container">
        <form action="{{ route('ovins.update', $ovin->id) }}" method="post">
            @csrf
            {{ method_field('PUT') }}
            <!-- @   method('PUT');-->
            <div class="row">
                <div class="row">
                    <label for="num">الرقم : </label>
                    <input type="text" class="form-control" name="num" value="{{ $ovin->num }}">
                </div>
                <div class="col">
                    <label for="date_achat">تاريخ الشراء : </label>
                    <input type="date" class="form-control" name="date_achat" value="{{ $ovin->date_achat }}"
                        readonly='readonly'>
                </div>
                <div class="col">
                    <label for="date_naissance">تاريخ الولادة : </label>
                    <input type="date" class="form-control" name="date_naissance" value="{{ $ovin->date_naissance }}"
                        readonly='readonly'>
                </div>
                <div class="row">
                    <label for="cause">سبب التعديل : </label>
                    <input type="text" class="form-control" name="cause" placeholder="السبب">
                </div>
                <div class="row">
                    <label for="poid">الوزن : </label>
                    <input type="number" class="form-control" name="poid"
                        value="{{ $ovin->poid }}"placeholder="الوزن">
                </div>
                <div class="col">
                    @if ($ovin->sexe == 1)
                        <input type="radio" id="Male" name="sexe" value="Male" checked>
                        <label for="Male">ذكر</label>
                        <input type="radio" id="Female" name="sexe" value="Female">
                        <label for="Female">أنثئ</label>
                    @else
                        <input type="radio" id="Male" name="sexe" value="Male">
                        <label for="Male">ذكر</label>
                        <input type="radio" id="Female" name="sexe" value="Female" checked>
                        <label for="Female">أنثئ</label>
                    @endif

                </div>
                <div class="row">
                    <button class="btn btn-primary" type="submit">تحديث</button>
                </div>
            </div>
        </form>
    </div>
@endsection
