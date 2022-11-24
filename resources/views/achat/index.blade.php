@extends('layouts.menu')
@section ('title')
قائمة الشراء
@endsection
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
 integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

@section ('contenu')
<h1> قائمة {{$titre}} </h1>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">العدد</th>
          <th scope="col">تاريخ {{$date}}</th>
          <th scope="col">الذكور</th>
          <th scope="col">الاناث</th>
          <th scope="col">الخراف</th>
          <th scope="col">البائع</th>
          <th scope="col">الثمن</th>

        </tr>
        </thead>
        <tbody>
         @foreach ($achats as $achat)
        <tr>
          <th scope="row">
              {{$achat->id}}</th>
          <td>{{$achat->nombre_achat}}</td>
          <td>{{$achat->date_achat}}</td>
          <td>{{$achat->nb_male}}</td>
          <td>{{$achat->nb_female}}</td>
          <td>{{$achat->nb_angeau}}</td>
          <td>{{$achat->id_vendeur}}</td>
          <td>{{$achat->prix_achat}}</td>
          @if ( $achat->updatable==1)
          <td><a class="btn btn-primary" href="{{route('achat.edit',$achat->id)}}" role="button" >تعديل</a></td>
          @else
          <td>مأكدة</td>
          @endif
          @if ( $achat->numerotable==1)
          <td>
            <a class="btn btn-success"  href="{{route('achat.anumeroter',$achat->id)}}" role="button">ترقيم</a>
        </td>
          @else
          <td>مرقمة</td>
          @endif
        </td>



        </tr>
          @endforeach
    </tbody>
    </table>
    إضهار من  {{$achats->firstItem()}} إلى {{$achats->LastItem()}} على {{$achats->total()}}
    {{ $achats->links()}}
    @endsection
