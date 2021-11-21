<div class="bg-white p-3 my-2">
    <address class="bg-light p-3">
        <p>Tax: Rp. {{ $transaction->transaction_tax }}</p>
        <p>Discount: {{ $transaction->transaction_discount * 100 }}%</p>
        <p>Status: {{ $transaction->status }}</p>
        <p>Deadline: {{ $transaction->transaction_deadline }}</p>
        <p>Pay Date: {{ $transaction->transaction_paydate }}</p>
    </address>
</div>