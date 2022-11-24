@extends('layouts.menu')
@section ('title')
<title>قائمة الاجهاضات </title>

@endsection

@section ('contenu')
<h1> قائمة الاجهاضات </h1>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">رقم الام</th>
          <th scope="col">تاريخ الاجهاض</th>
          <th scope="col">العدد </th>
          <th scope="col">التبليغ من</th>
        </tr>
        </thead>
        <tbody>

         @foreach ($avorters as $avorter)
        <tr>
          <th scope="row">
              {{$avorter->id}}</th>
          <td>{{$avorter->num}}</td>
          <td>{{$avorter->date_avorter}}</td>
          <td>{{$avorter->nombre}}</td>
          <td>{{$avorter->name}}</td>
          <td><a class="btn btn-primary" href="{{route('ovins.edit',$avorter->id)}}" role="button" >تعديل</a>
        </td>
      </tr>
          @endforeach
    </tbody>
    </table>
    إضهار من  {{$avorters->firstItem()}} إلى {{$avorters->LastItem()}} على {{$avorters->total()}}
    {{ $avorters->links()}}
    @endsection
