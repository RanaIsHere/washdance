<div class="row my-4">
    <div class="col-md">
        <div class="bg-white p-4">
            <h5>Total Sales</h5>
            <hr>
            <h4>{{ $wd_transactions->count() }}</h4>
            <p class="text-muted">{{ ($wd_transactions->count() / 100) }}%</p>
        </div>
    </div>

    <div class="col-md">
        <div class="bg-white p-4">
            <h5>Active Members</h5>
            <hr>
            <h4>{{ $wd_members->count() }}</h4>
            <p class="text-muted">{{ ($wd_members->count() / 100) }}%</p>
        </div>
    </div>

    <div class="col-md">
        <div class="bg-white p-4">
            <h5>Active Outlets</h5>
            <hr>
            <h4>{{ $wd_outlets->count() }}</h4>
            <p class="text-muted">{{ ($wd_outlets->count() / 100) }}%</p>
        </div>
    </div>

    <div class="col-md">
        <div class="bg-white p-4">
            <h5>Active Packages</h5>
            <hr>
            <h4>{{ $wd_packages->count() }}</h4>
            <p class="text-muted">{{ ($wd_packages->count() / 100) }}%</p>
        </div>
    </div>
</div>