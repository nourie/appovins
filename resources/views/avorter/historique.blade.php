<h2> الولادات السابقة </h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">التاريخ</th>
            <th scope="col">الحدث</th>
            <th scope="col">العدد</th>
            <th scope="col">التبليغ من</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($avorternaissances as $avorternaissances)
            <tr>
                <th scope="row">{{ (string) $avorternaissances->id }}</th>
                <td>{{ $avorternaissances->date }}</td>
                <td>
                    @if ($avorternaissances->nas)
                        ولادة
                    @else
                        إجهاض
                    @endif
                </td>
                <td>{{ $avorternaissances->nombre }}</td>
                <td>{{ $avorternaissances->name }}</td>

            </tr>
        @endforeach
    </tbody>
</table>
 {{-- إضهار من  {{$avorternaissances->firstItem()}} إلى {{$avorternaissances->LastItem()}} على {{$avorternaissances->total()}}
    {{ $avorternaissances->links()}} --}}

</body>
