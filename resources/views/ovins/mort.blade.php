
@extends('layouts.menu')
@section ('title')
<title>نفوق حيوان</title>
@endsection
@section ('contenu')
<h1>نفوق حيوان</h1>
{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}
<form  action="{{route('ovins.adddie',$ovins->id)}}" method="post" >
    @csrf
    {{ method_field('PUT') }}
    <!-- @   method('PUT');-->
     <div class="col-mb-3">
        <label for="numéro" class="form-label">الرقم : </label>
        <input type="number" id="num" name="num" maxlength = 20 minlength=1 class="form-control" class="@error('num') is-invalid @enderror" required value="{{$ovins->num}}" readonly="readonly">
        @error('num')
           <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    @if (is_null($ovins->date_achat))
</div>
<div class="mb-3">
 <label for="date_achat">تاريخ الولادة : </label>
 <input type="date" id="date_achat" name="date_achat" required class="@error('date_achat') is-invalid @enderror" value="{{$ovins->date_naissance}}" readonly="readonly">
</div>
    @else
</div>
<div class="mb-3">
 <label for="date_achat">تاريخ الشراء : </label>
 <input type="date" id="date_achat" name="date_achat" required class="@error('date_achat') is-invalid @enderror" value="{{$ovins->date_achat}}" readonly="readonly">
</div>
    @endif



    <div class="mb-3">
        <label for="poid"> الوزن : </label>
        <input type="number" class="form-control" id="poid" name="poid" minlength=1 maxlength=3 value="{{$ovins->poid}}" readonly="readonly">
    </div>


    <div class="mb-3">
    @if ($ovins->sexe==0)
      <label for="female">الجنس:أنثى </label>


    @else
    <label for="male">الجنس: ذكر</label>


    @endif

    </div>
</div>
<div class="mb-3">
 <label for="die_date">تاريخ الموت : </label>

 <input type="date" id="die_date" name="die_date" required class="@error('die_date') is-invalid @enderror"
 @if (is_null($ovins->date_naissance) )
 min="{{(date('Y-m-d',strtotime($ovins->date_achat)))}}"
 @else
 min="{{(date('Y-m-d',strtotime($ovins->date_naissance)))}}"
 @endif
 value="{{date('Y-m-d')}}" max="{{date('Y-m-d')}}" >
</div>
<input type="radio" id="ego" name="die_status" value="1" >
              <label for="ego">ذبح</label>
              <input type="radio" id="mort" name="die_status" value="0" checked>
              <label for="mort">موت</label>
<div class="mb-3">
    <label for="die_cause">السبب : </label>
    <input type="text" id="die_cause" name="die_cause" maxlength = 200 minlength=1 class="@error('die_cause') is-invalid @enderror" required placeholder="سبب الموت">
    @error('cause')
       <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

    <div class="mb-3" id="submit">
        <input type="submit" value="تأكيد">
    </div>
</form>
@endsection
@section ('sidebar')
@parent
<h1> poste side barre  </h1>
@endsection

