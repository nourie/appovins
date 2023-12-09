@extends('layouts.menu')
@section('title')
     بيع الحيوانات 
@endsection
@section('contenu')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    </div>
    <div class="card">
        <div class="card-body">
            <div class="container mb-5 mt-3">
                <div class="row d-flex align-items-baseline">
                    <div class="col-xl-9">
                        <p style="color: #7e8d9f;font-size: 20px;"> <strong>بيع الحيوانات</strong></p>
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


                    <p class="text-muted">الحيوان</p>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="form-control me-2" action="{{ route('vente.search') }}" method="GET" role="search">
                        {{ method_field('get') }}
                        {{ csrf_field() }}

                        <ul class="list-unstyled">
                            @if (count($temps) > 0)
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                        class="fw-bold"><input class="form-control me-2" type="date" name="date_vente"
                                            value="{{ $temps[0]->date_vente }}" required></li>
                            @else
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                        class="fw-bold"><input class="form-control me-2" type="date" name="date_vente"
                                            value="{{ date('Y-m-d') }}" required></li>
                            @endif
                            <div class="c100">
                                <label for="id_acheteur">المشتري:</label>

                                <select name="id_acheteur" id="id_acheteur">

                                    <optgroup label="---">
                                        @php
                                          if (count($temps) > 0)
                                          {

                                           $users =\App\Models\User::where('id',$temps[0]->id_acheteur)->get();

                                          }
                                        else {
                                            $users = \App\Models\User::where('userrole', 4)->get();
                                        }
                                        @endphp
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </optgroup>
                                </select>

                            </div>


                            <li class="text-muted">
                                {{ $error }}
                                <input class="form-control me-2" type="text" placeholder="الرقم" aria-label="البحث"
                                    name="num" required value={{ old('num') }}>
                                <i class="fas fa-circle" style="color:#84B0CA ;"> السعر</i> <span class="fw-bold">
                                    <input class="form-control me-2" type="number" min=0 step="0.01"
                                        placeholder="السعر" aria-label="البحث" name="prix_vente" required value={{ old('prix_vente') }}>

                                    <button class="btn btn-outline-success" type="submit">إضافة</button>
                            </li>


                        </ul>
                    </form>
                </div>
            </div>

            <div class="row my-2 mx-1 justify-content-center">
                <table class="table table-striped table-borderless">
                    <thead style="background-color:#84B0CA ;" class="text-white">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">الرقم</th>
                            <th scope="col">السعر</th>
                            <th scope="col">الجنس</th>
                            <th scope="col">تاريخ الشراء</th>
                            <th scope="col">تاريخ الولادة </th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ($temps as $temp)
                                <th scope="row">{{ $temp->id }}</th>
                                <td>{{ $temp->num }}</td>
                                <td>{{ $temp->prix_vente }}</td>
                                @if ($temp->sexe == 1)
                                    <td>ذكر</td>
                                @else
                                    <td>أنثى</td>
                                @endif

                                <td>{{ $temp->date_achat }}</td>
                                <td>{{ $temp->date_naissance }}</td>
                                <td> <a class="btn btn-danger" href="{{ route('vente.delete', $temp->id) }}" role="button">حذف</a></td>
                        </tr>
                        @endforeach




                    <tr>
                        <td> عدد الحيوانات  :{{ $nombres }}</td>
                        <td>..</td>
                        <td>الثمن الكلي  :{{ $total }}</td>
                        <td>  كباش: {{ $nombremale }} | نعاج:</span>{{ $nombrefemale }}|خراف  :{{ $nombreagneaux }}</td>
                        <td>...</td>
                        <td>...</td>
                    </tr>
                    </tbody>

                </table>
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
            <div class="row">

                <div class="col-xl-2">
                    <a type="button" class="btn btn-primary text-capitalize" style="background-color:#60bdf3 ;"
                    href="{{ route('vente.valider') }}">تأكيد البيع
                        </a>


                </div>
            </div>

        </div>
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
