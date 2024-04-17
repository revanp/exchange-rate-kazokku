@extends('layouts.app')

@section('content')
<div class="subheader py-2 py-lg-4  subheader-solid" id="kt_subheader">
    <div class="container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-2">
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                Dashboard
            </h5>
        </div>
    </div>
</div>

<div class="d-flex flex-column-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-custom">
                    <div class="card-header">
                        <div class="card-title">
                            Exchange Rate
                            &nbsp;
                            <small class="text-muted">({{ date('d F Y') }})</small>
                        </div>
                        <div class="card-toolbar">
                            <button class="btn btn-primary btn-refresh">Refresh Price</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Base Currency</th>
                                    <th>Quote Currency</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
