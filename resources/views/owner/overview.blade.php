<div class="row">
    <div class="col-md">
        <div class="bg-white p-4" style="height: 100%">
            <h4> Washdance Corporation </h4>
            <p class="text-muted"> A forked corporation of Origin Corporation </p>

            <h6> A corporation that has been forked since the death of Origin Corporation that was built circa 2004.</h6>
            <h6> Washdance is a laundry franchise built since 2019 of this era, and has been growing ever since.</h6>
            <h6> It is your duty to take care of the company as an owner.</h6>
        </div>
    </div>

    <div class="col-md">
        <div class="bg-white p-4">
            <img src="https://source.unsplash.com/1600x900/?corporation" class="img-fluid" alt="The image of the corporation">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md">
        <div class="bg-white p-4 my-4">
            <h4>Employees</h4>
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>CREATED AT</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($user as $u)
                        <tr>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td>{{ $u->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>