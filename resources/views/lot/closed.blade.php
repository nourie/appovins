@extends('layouts.menu')
@section('title')
    إضافة مجموعة
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
    <form action="{{route('lot.closelot')}}">
        @csrf
        {{ method_field('GET') }}
        <!-- @   method('GET');-->
        <input type="hidden" name="id" value ="{{$lot->id}}">
        <div class="form-row align-items-center">

            <div class="col-auto">
                <label for="declareur">لون المجموعة:</label>
                <input type="text" name="color" class="form-control mb-2" id="inlineFormInput" value="{{$lot->name}}" placeholder="اللون" readonly="readonly">

            </div>
            <div class="col-auto">
                <label class="sr-only" for="inlineFormInput"> تاريخ البداية</label>
                <input type="date" name="debut_lot" class="form-control mb-2" id="inlineFormInput" value="{{$lot->debut_lot}}" readonly="readonly">
            </div>
              <div class="col-auto">
                <label for="nombre"> عدد الخراف:</label>
                <input type="text" name="color" class="form-control mb-2" id="inlineFormInput" value="{{$nbr}}"  readonly="readonly">

            </div>
            
            <div class="col-auto" >
                <label class="sr-only" for="inlineFormInput"> تاريخ النهاية</label>
                <input type="date" name="fin_lot" class="form-control mb-2" id="inlineFormInput"  {{ old('fin_lot') }} required>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-2">إنهاء</button>
            </div>
        </div>
    </form>
@endsection
