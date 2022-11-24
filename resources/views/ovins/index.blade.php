@extends('layouts.menu')
@section('title')
    قائمة الحيوانات
@endsection
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

@section('contenu')
    <h1> قائمة الحيوانات</h1>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">الرقم</th>
                <th scope="col">تاريخ ش/و</th>
                <th scope="col">السن</th>
                <th scope="col">الجنس</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($ovins as $ovin)
                <tr>
                    <th scope="row">
                        {{ $ovin->id }}</th>
                    <td>{{ $ovin->num }}</td>
                    @if (is_null($ovin->date_naissance))
                        <td>{{ $ovin->date_achat }} ش</td>
                        <td> شراء </td>
                    @elseif ($ovin->alive == 0)
                        <td>{{ $ovin->date_naissance }} و</td>

                        <td> @inject('provider', 'App\Http\Controllers\OvinController')
                            {{ $provider::age($ovin->date_naissance, $ovin->die_date)[4] }}</td>
                    @else
                        <td>{{ $ovin->date_naissance }} و</td>
                        <td> @inject('provider', 'App\Http\Controllers\OvinController')
                            {{ $provider::age($ovin->date_naissance, date('Y-m-d'))[4] }}</td>
                    @endif

                    @if ($ovin->sexe == 1)
                        <td>ذكر</td>
                    @else
                        <td>أنثى</td>
                    @endif
                    @if ($ovin->alive == 1 && $ovin->vendu == 0)
                        <td><a class="btn btn-primary" href="{{ route('ovins.edit', $ovin->id) }}" role="button">تعديل</a>
                            @inject('provider', 'App\Http\Controllers\OvinController')

                            @if ($ovin->sexe == 0 && $provider::age($ovin->date_naissance, date('Y-m-d'))[0])
                                <a class="btn btn-success" href="{{ route('ovins.naissance', $ovin->id) }}"
                                    role="button">ولادة</a>
                                <a class="btn btn-warning" href="{{ route('ovins.avorter', $ovin->id) }}"
                                    role="button">إجهاض</a>

                            @endif
                        </td>

                        <td>
                            <form method="POST" action="{{ url('/ovins' . '/' . $ovin->id) }}">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button class="btn btn-danger" name="delete" type="submit">نفوق</button>
                            </form>
                        </td>
                    @else
                        @if ($ovin->vendu == 1)
                            <td>بيع </td>
                        @elseif ($ovin->vendu==2)
                        <td>إعادة </td>
                        @else                        @
                            <td>ميتة </td>
                        @endif
                    @endif

                </tr>
            @endforeach
        </tbody>
    </table>
    إظهار من {{ $ovins->firstItem() }} إلى {{ $ovins->LastItem() }} على {{ $ovins->total() }}
    {{ $ovins->links() }}
@endsection
