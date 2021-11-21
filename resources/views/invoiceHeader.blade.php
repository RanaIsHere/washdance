<div class="p-4 bg-white my-2">
    <h1 class="fw-bold"> #{{ $transaction->invoice_code }}</h1>
    <p class="text-muted mb-0"> From Outlet: {{ $transaction->outlets->outlet_name }}</p>
    <p class="text-muted">On {{ $transaction->transaction_date }}</p>
</div>