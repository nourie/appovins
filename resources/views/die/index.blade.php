@extends('layouts.menu')
@section('title')
    <title>قائمة الميتة </title>
@endsection
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

@section('contenu')
    <h1> قائمة الميتة </h1>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">


    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">الرقم</th>
                <th scope="col">تاريخ ش/و</th>
                <th scope="col">تاريخ النفوق</th>
                <th scope="col">الجنس</th>
                <th scope="col">الحالة</th>
                <th scope="col">السبب</th>



            </tr>
        </thead>
        <tbody>
            @foreach ($ovins as $ovin)
                <tr>
                    <th scope="row">
                        {{ $ovin->id }}</th>
                    <td>{{ $ovin->num }}</td>
                    @if (is_null($ovin->date_achat))
                        <td>{{ $ovin->date_naissance }} و</td>
                    @else
                        <td>{{ $ovin->date_achat }} ش</td>
                    @endif

                    <td>{{ $ovin->die_date }}</td>
                    @if ($ovin->sexe == 1)
                        <td>ذكر</td>
                    @else
                        <td>أنثى</td>
                    @endif
                    @if ($ovin->die_status == 1)
                        <td>ذبح</td>
                    @else
                        <td>موت</td>
                    @endif
                    <td>{{ $ovin->die_cause }}</td>

                    <td><a class="btn btn-primary" href="{{ route('ovins.edit', $ovin->id) }}" role="button">تعديل</a>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    إظهار من {{ $ovins->firstItem() }} إلى {{ $ovins->LastItem() }} على {{ $ovins->total() }}
    {{ $ovins->links() }}
@endsection
