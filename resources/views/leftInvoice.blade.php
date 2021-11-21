<div class="bg-white p-4 my-2">
    <address class="bg-light p-4">
        <p>To: {{ $transaction->members->member_name }}</p>
        <p>From: {{ $transaction->outlets->outlet_name }}</p>
        <p>By: {{ $transaction->user->name }}</p>
        <p>Status: {{ $transaction->paid_status }}</p>
    </address>
</div>