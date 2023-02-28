@extends('layouts.menu')
@section('title')
    إضافة مجموعة
@endsection

@section('contenu')
    <form action="{{route('lot.insert')}}">
        @csrf
        {{ method_field('GET') }}
        <!-- @   method('GET');-->
        <div class="form-row align-items-center">

            <div class="col-auto">
                <label for="declareur">لون المجموعة:</label>
                <select class="form-control mb-2" id="inlineFormInput" name="couleur" id="couleur">

                    <optgroup label="---">

                        @foreach ($colors as $color)
                            <option style="background:{{ $color->code_html }}" value="{{ $color->id }}">{{ $color->name }}
                            </option>
                        @endforeach
                    </optgroup>
                </select>

            </div>
            <div class="col-auto">
                <label class="sr-only" for="inlineFormInput"> تاريخ البداية</label>
                <input type="date" name="debut_lot" class="form-control mb-2" id="inlineFormInput" placeholder="اللون">
            </div>
            
           
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-2">إضافة</button>
            </div>
        </div>
    </form>
@endsection
