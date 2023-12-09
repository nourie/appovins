@extends('layouts.menu')
@section('title')
    الإرضاع
@endsection
@section('contenu')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    </div>
    <div class="card">
        <div class="card-body">
            <div class="container mb-5 mt-3">
                <div class="row d-flex align-items-baseline">
                    <div class="col-xl-9">
                        <p style="color: #7e8d9f;font-size: 20px;"> <strong>الإرضاع</strong></p>
                    </div>
                    <div class="col-xl-3 float-end">
                        <a class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark"><i
                                class="fas fa-print text-primary"></i> طباعة</a>
                        <a class="btn btn-light text-capitalize" data-mdb-ripple-color="dark"><i
                                class="far fa-file-pdf text-danger"></i> تصدير</a>
                    </div>
                    <hr>
                </div>
                <div class="col-xl-2">


                    <p class="text-muted">المعلومات</p>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="form-control me-2" action="{{ route('alaite.search') }}" method="GET" role="search">
                        {{ method_field('get') }}
                        {{ csrf_field() }}

                        <ul class="list-unstyled">
                            <li class="text-muted">
                                {{ $erroral }}
                                <input class="form-control me-2" type="text" placeholder="رقم المرضعة" aria-label="البحث"
                                    name="numali" required value="{{ $numali }}">
                            </li>
                            <li class="text-muted">
                                {{ $errorme }}
                                <input class="form-control me-2" type="text" placeholder="رقم الأم" aria-label="البحث"
                                    name="nummere" required value="{{ $nummere }}">
                                <button class="btn btn-outline-success" type="submit">بحث</button>
                            </li>


                        </ul>
                    </form>

                </div>




                <div class="row">

                    <div class="col-xl-3">
                        <ul class="list-unstyled">
                            <li class="text-muted ms-3">


                                <span class="text-black me-2">
                                    <span class="text-black me-2">


                            </li>
                        </ul>
                    </div>
                </div>
                <hr>


            </div>
        </div>
        <div class="row my-2 mx-1 justify-content-center">
            <table class="table table-striped table-borderless">
                <thead style="background-color:#84B0CA ;" class="text-white">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">الرقم</th>
                        <th scope="col">تاريخ الولادة </th>
                        <th scope="col">الجنس</th>
                        <th scope="col">الرقم في المجموعة</th>
                        <th scope="col">إرضاع</th>



                    </tr>
                </thead>
                <tbody>

                    <tr>
                        @foreach ($petits as $petit)
                            @if ($petit->checked == '')
                                <th scope="row">{{ $petit->id_ovin }}</th>
                                <td>{{ $petit->num }}</td>
                                <td>{{ $petit->date_naissance }}</td>
                                @if ($petit->sexe == 1)
                                    <td>ذكر</td>
                                @else
                                    <td>أنثى</td>
                                @endif
                                <td>{{ $petit->num_in_lot }}</td>
                                

                                <td> <input name="box" type="checkbox" id="{{ $petit->id_ovin }}"
                                        value="{{ $petit->id_ovin }}" {{ $petit->checked }}> </td>
                            @endif
                            <div class="col-xl-2">
                                <button type="button" name="submit" id="submit" class="btn btn-primary text-capitalize"
                                    style="background-color:#60bdf3 ;"> حفض </button>
                            </div>
                         
                           

                    </tr>
                    @endforeach



        </div>
    </div>


    </tbody>







    </table>

    </div>
    </div>
    </div>

@endsection

<div>
    @guest
        <div class="shrink-0 flex items-center">
            <a href="{{ route('dashboard') }}">
                يجب تسجيل الدخول
            </a>
        </div>
    @endguest
</div>
