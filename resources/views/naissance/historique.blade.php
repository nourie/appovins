<h2>
    المواليد </h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">الرقم</th>
            <th scope="col">التاريخ</th>
            <th scope="col">الجنس</th>
            <th scope="col">الحالة</th>
            <th scope="col">السن</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($angnaux as $angnau)
            <tr>
                <th scope="row">{{ (string) $angnau->id }}</th>
                <td>{{ $angnau->num }}</td>

                <td>{{ $angnau->date_naissance }}</td>
                <td>
                    @if ($angnau->sexe == 1)
                        ذكر
                    @else
                        أنثى
                    @endif
                </td>
                <td>
                    @if ($angnau->vendu == 1)
                        بيع
                    @elseif($angnau->alive == 0)
                        ميتة
                    @else
                        حية
                    @endif
                </td>
                <td>
                    @if ($ovin->alive == 0)
                        @inject('provider', 'App\Http\Controllers\OvinController')
                        {{ $provider::age($angnau->date_naissance, $angnau->die_date)[4] }}
                    @else
                        @inject('provider', 'App\Http\Controllers\OvinController')
                        {{ $provider::age($angnau->date_naissance, date('Y-m-d'))[4] }}
                    @endif
                </td>

            </tr>
        @endforeach
    </tbody>
</table>
</body>
