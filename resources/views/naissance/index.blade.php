@extends('layouts.menu')
@section ('title')
<title>قائمة الولادات </title>

@endsection

@section ('contenu')
<h1> قائمة الولادات </h1>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">رقم الام</th>
          <th scope="col">تاريخ الولادة</th>
          <th scope="col">العدد </th>
          <th scope="col">الأحياء</th>
          <th scope="col">الذكور</th>
          <th scope="col">الاناث</th>
          <th scope="col">التبليغ من</th>
        </tr>
        </thead>
        <tbody>

         @foreach ($naissances as $naissance)
        <tr>
          <th scope="row">
              {{$naissance->id}}</th>
          <td>{{$naissance->num}}</td>
          <td>{{$naissance->date_naissance}}</td>
          <td>{{$naissance->nombre}}</td>
          <td>{{$naissance->nombre_en_vie}}</td>
          <td>{{$naissance->nombre_male}}</td>
          <td>{{$naissance->nombre_female}}</td>
          <td>{{$naissance->name}}</td>

          
        </tr>
          @endforeach
    </tbody>
    </table>
    إضهار من  {{$naissances->firstItem()}} إلى {{$naissances->LastItem()}} على {{$naissances->total()}}
    {{ $naissances->links()}}
    @endsection
