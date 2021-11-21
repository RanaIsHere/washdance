<div class="bg-white p-3 my-3">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>PACKAGE NAME</th>
                <th>PACKAGE QUANTITY</th>
                <th>TOTAL PRICE</th>
                <th>NOTES</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($transaction->transactionDetails as $tdr)
            <tr>
                <td>{{ $tdr->packages->package_name }}</td>
                <td>{{ $tdr->quantity }}</td>
                <td>{{ $tdr->transactions->transaction_paid + $tdr->transactions->transaction_paid_extra }}</td>
                <td>{!! $tdr->notes !!}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>