@extends('layouts.menu')
@section('title')
    قائمة المجموعات
@endsection

@section('contenu')
    <h1> قائمة المجموعات</h1>


    @if ($err != 1)
        <div class="alert alert-danger">{{ $err }}</div>
    @endif


    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">اللون</th>
                <th scope="col">البداية</th>
                <th scope="col">النهاية</th>
                <th scope="col">عدد الخرفان</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($lots as $lot)
                <tr>
                    <th scope="row">
                        {{ $lot->id }}</th>
                    <td>{{ $lot->name }}</td>
                    <td>{{ $lot->debut_lot }}</td>

                    @if (auth()->user()->userrole == 1)
                        @if (is_null($lot->fin_lot))
                            <td> مفعل <a class="btn btn-info" href="{{ route('lot.close', $lot->id) }}"
                                    role="button">إنهاء</a></td>
                        @else
                            <td>{{ $lot->fin_lot }} </td>
                        @endif
                    @else
                        @if (is_null($lot->fin_lot))
                            <td> مفعل </td>
                        @else
                            <td>{{ $lot->fin_lot }} </td>
                        @endif
                    @endif
                     <td> <a href="{{route('lot.inlot', $lot->id)}}"> {{ $lot->nbr_ovins }}  </a></td>



                    




                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
