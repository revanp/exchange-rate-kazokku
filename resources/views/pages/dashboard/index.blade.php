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
                            @if (!empty($currencies))
                                <small class="text-muted">({{ $currencies->created_at->diffForHumans() }})</small>
                            @endif
                        </div>
                        <div class="card-toolbar">
                            @if (Auth::user()->role->name == 'Admin')
                                <button class="btn btn-primary btn-refresh">Refresh Price</button>
                            @endif
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
                            <tbody>
                                @foreach ($currencies->quoteCurrency as $key => $val)
                                    <tr>
                                        <td>{{ $currencies->currency }}</td>
                                        <td>{{ $val->currency }}</td>
                                        <td>{{ $val->rate }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        @if (Auth::user()->role->name == 'Admin')
            $(document).on('click', '.btn-refresh', function(e){
                e.preventDefault();

                Swal.fire({
                    title: "Are you sure you want to refresh price?",
                    text: "This will update the data permanently. You cannot undo this action",
                    icon: "info",
                    buttonsStyling: false,
                    confirmButtonText: "<i class='la la-thumbs-up'></i> Yes!",
                    showCancelButton: true,
                    cancelButtonText: "<i class='la la-thumbs-down'></i> No, thanks",
                    customClass: {
                        confirmButton: "btn btn-danger",
                        cancelButton: "btn btn-default"
                    }
                }).then(function(isConfirm) {
                    if(isConfirm.isConfirmed){
                        $.ajax({
                            url: '{{ url("update-price") }}',
                            type: 'POST',
                            data: {
                                "_token": '{{ csrf_token() }}'
                            },
                            success: function(data){
                                if(data.redirect != null){
                                    window.location.replace(data.redirect);
                                }
                            },
                            error: function(data){
                                var result = data.responseJSON;
                                toastr.error(result.message);
                            }
                        })
                    }
                });
            })
        @endif
    </script>
@endsection
