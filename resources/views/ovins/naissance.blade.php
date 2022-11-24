@extends('layouts/menu')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    @section('title')
        إضافة مواليد جدد
    @endsection
    @section('contenu')
        <script>
            function somme() {
                var nbr1, nbr2, sum;
                nbr1 = Number(document.getElementById("nombre_en_vie").value);
                nbr2 = Number(document.getElementById("nombre_male").value);
                sum = nbr1 - nbr2;
                document.getElementById("nombre_female").value = sum;

            }

            function valider() {
                var a, b, c, d;
                a = Number(document.getElementById("nombre").value);
                b = Number(document.getElementById("nombre_en_vie").value);
                c = Number(document.getElementById("nombre_male").value);
                d = Number(document.getElementById("nombre_female").value);

                if (a < b) {
                    alert(' عدد المولبد الأحياء يكون أصغر أو يساوي عدد المواليد');
                    document.getElementById("nombre_en_vie").value = a;
                } else {
                    if ((c + d) != b) {
                        if (a < b) {

                            document.getElementById("nombre_female").value = a - c;
                        } else {
                            document.getElementById("nombre_female").value = b - c;
                        }

                        if (b - c < 0) {
                            alert(' مجموع الذكور و الاناث خاطئ');
                            document.getElementById("nombre_male").value = b;
                            document.getElementById("nombre_female").value = 0;

                        }


                    }
                }
            }
        </script>
    </head>


    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <body>
        <form action="{{ route('ovins.addnaissance', $ovin->id) }}" method="post">
            @csrf
            {{ method_field('GET') }}
            <!-- @   method('GET');-->
            <div class="row">
                <div class="col">

                    <label for="num">رقم الأم : </label>
                    <input type="text" class="form-control" name="num" value="{{ $ovin->num }}"
                        readonly="readonly">
                </div>

                <div class="col">

                    <label for="date_naissance"> تاريخ الولادة </label>
                    <input type="date" class="form-control" name="date_naissance"
                    value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}">

                </div>

                <div class="col">

                    <label for="nombre">العدد : </label>
                    <input type="number" class="form-control" name="nombre" value="1" id="nombre" min=1  step="1">
                </div>


                <div class="col">
                    <label for="nombre_en_vie">الأحياء : </label>
                    <input type="number" class="form-control" id='nombre_en_vie' name="nombre_en_vie" id="nombre_en_vie"
                    min=0  step="1" value="1" onchange onpropertychange onkeyuponpaste oninput="valider()">
                </div>

                <div class="col">
                    <label for="nombre_male">الذكور الأحياء : </label>
                    <input type="number" id='nombre_male'class="form-control" name="nombre_male" value="1" onchange
                    min=0  step="1" onpropertychange onkeyuponpaste oninput="valider()">
                </div>

                <div class="col">
                    <label for="nombre_female">الإناث الأحياء : </label>
                    <input type="number" id='nombre_female' class="form-control" name="nombre_female" value="0"
                    min=0  readonly="readonly">

                </div>
                <div class="col">
                    <label for="declareur">تبليغ من :</label>
                    <select class="form-select form-select-lg mb-3" name="declareur" id="declareur">

                        <optgroup label="---">
                            @php
                                $user = \App\Models\User::where('userrole', 2)->get();
                            @endphp
                            @foreach ($user as $users)
                                <option value="{{ $users->id }}">{{ $users->name }}</option>
                            @endforeach
                        </optgroup>
                    </select>
                </div>


                <div class="col">
                    <button class="btn btn-primary" type="submit">إضافة الولادة</button>
                </div>
            </div>
        </form>
        @include('avorter.historique')

    </body>

    </html>
@endsection
