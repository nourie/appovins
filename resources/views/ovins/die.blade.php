
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <form  action="{{route('ovins.update',$ovin->id)}}" method="post" >
        @csrf
        {{ method_field('PUT') }}
        <!-- @   method('PUT');-->
        <div class="row">
            <div class="col">
              <label for="num">Numéro : </label>
              <input type="text" class="form-control" name="num"  value="{{$ovin->num}}">
            </div>
            <div class="col">
              <label for="date_die">Date achat : </label>
              <input type="date" class="form-control" name="date_die" value="{{$ovin->date_achat}}">
            </div>
            <div class="col">
              <label for="num">poids : </label>
              <input type="number" class="form-control" name="poid" value="{{$ovin->poid}}">
            </div>
            <div class="c100">
              @if ( $ovin->sexe==1)
              <input type="radio" id="Male" name="sexe" value="Male"  checked>
              <label for="Male">Male</label>
              <input type="radio" id="Female" name="sexe" value="Female" >
              <label for="Female">Female</label>
                @else
                <input type="radio" id="Male" name="sexe" value="Male"  >
                <label for="Male">Male</label>
                <input type="radio" id="Female" name="sexe" value="Female" checked >
                <label for="Female">Female</label>
                @endif

          </div>
      <div class="col">
        <button class="btn btn-primary" type="submit">Update</button>
      </div>
    </div>
  </form>
