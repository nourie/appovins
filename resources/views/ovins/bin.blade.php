@extends('layouts.menu')
@section ('title')
قائمة الحيوانات المحذوفة

@endsection
@section ('contenu')

<h1> قائمة الحيوانات المحذوفة</h1>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <form action="">
        <div class="form-group">
          <label for="numero">numéro animal</label>
          <input type="number" class="form-control" id="num" aria-describedby="number" placeholder="Enter numéro">
          </div>

        <button type="search" class="btn btn-primary">Submit</button>
      </form>
    <a class="btn btn-danger" href="" role="button">Delete All</a>
    <a class="btn btn-danger" href="" role="button">Delete All trunck</a>

    <table caption="liste table" class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Num</th>
          <th scope="col">Date_achat</th>
          <th scope="col">Poids</th>
          <th scope="col">Sexe</th>

        </tr>
        </thead>
        <tbody>
         @foreach ($ovins as $ovin)
        <tr>
          <th scope="row">
              {{$ovin->id}}</th>
          <td>{{$ovin->num}}</td>
          <td>{{$ovin->date_achat}}</td>
          <td>{{$ovin->poid}}</td>
          @if ( $ovin->sexe==1)
          <td>Male</td>
          @else
          <td>Female</td>
          @endif

          <td><a class="btn btn-primary" href="{{ url('ovins/restore/'.$ovin->id)}}" role="button" >Restore</a>
              <a class="btn btn-danger"  href="{{ route('ovins.fdelete',$ovin->id)}}" role="button">permDelete</a>
        </td>
        </tr>
          @endforeach
    </tbody>
    </table>
    @endsection
