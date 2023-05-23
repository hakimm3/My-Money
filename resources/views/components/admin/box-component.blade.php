<div>
    <div class="card mt-2">
        <div class="container-fluid">
            <div class="row justify-content-start">
                <div class="col-sm-4">
                    <button onclick="history.back()" class="btn btn-default mt-2 mb-4"><i
                            class="fa fa-arrow-left text-black"></i> Back</button>
                    <button onclick="location.reload()" class="btn btn-default mt-2 mb-4"><i
                            class="fa fa-history text-black"></i> Reload</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            {{ $boxBody }}
        </div>
    </div>
</div>
