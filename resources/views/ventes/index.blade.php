@extends('layouts.menu')
@section ('title')
قائمة البيع
@endsection
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
 integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

@section ('contenu')
<h1> قائمة البيع </h1>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">العدد</th>
          <th scope="col">تاريخ البيع</th>
          <th scope="col">الذكور</th>
          <th scope="col">الاناث</th>
          <th scope="col">الخراف</th>
          <th scope="col">المشتري</th>
          <th scope="col">الثمن</th>

        </tr>
        </thead>
        <tbody>
         @foreach ($ventes as $Vente)
        <tr>
          <th scope="row">
              {{$Vente->id}}</th>
          <td>{{$Vente->nombre_vente}}</td>
          <td>{{$Vente->date_vente}}</td>
          <td>{{$Vente->nb_male}}</td>
          <td>{{$Vente->nb_female}}</td>
          <td>{{$Vente->nb_angeau}}</td>
          <td>{{$Vente->name}}</td>
          <td>{{$Vente->prix_vente}}</td>
          @if ( $Vente->updatable==1)
          <td><a class="btn btn-primary" href="{{route('achat.edit',$vente->id)}}" role="button" >تعديل</a></td>
          @else
          <td>مأكدة</td>
          @endif
         </td>



        </tr>
          @endforeach
    </tbody>
    </table>
    إضهار من  {{$ventes->firstItem()}} إلى {{$ventes->LastItem()}} على {{$ventes->total()}}
    {{ $ventes->links()}}
    @endsection
