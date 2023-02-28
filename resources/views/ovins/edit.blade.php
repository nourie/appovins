@extends('layouts.menu')
@section('title')
    التعديل 
@endsection
@section('contenu')
 @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

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
                <div class="col">
                    @if ($ovin->taged == 1)
                        <input type="radio" id="taged" name="taged" value="1" checked>
                        <label for="taged">ترقيم</label>
                        <input type="radio" id="other" name="taged" value="0">
                        <label for="other">آخر</label>
                    @else
                        <input type="radio" id="taged" name="taged" value="1">
                        <label for="taged">ترقيم</label>
                        <input type="radio" id="other" name="taged" value="0" checked>
                        <label for="other">آخر</label>
                    @endif

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
