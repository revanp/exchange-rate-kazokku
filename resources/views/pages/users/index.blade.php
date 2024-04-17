@extends('layouts.app')

@section('content')
<div class="subheader py-2 py-lg-4  subheader-solid" id="kt_subheader">
    <div class="container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-2">
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                Users
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
                            Users List
                        </div>
                        <div class="card-toolbar">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUser">
                                Add User
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 5%">No. </th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th style="width: 15%" class="text-center">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $val)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $val->name }}</td>
                                        <td>{{ $val->username }}</td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="ki ki-bold-more-ver"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item btn-edit" href="{{ url('users/edit/'.$val->id) }}">Edit</a>
                                                    <a class="dropdown-item btn-delete" href="{{ url('users/delete/'.$val->id) }}">Delete</a>
                                                </div>
                                            </div>
                                        </td>
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

<div class="modal fade" id="addUser" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form action="{{ url('users/create') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control form-control-solid" placeholder="Enter name" name="name"/>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control form-control-solid" placeholder="Enter username" name="username"/>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control form-control-solid" placeholder="Enter password" name="password"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editUser" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form action="#" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control form-control-solid" placeholder="Enter name" name="name"/>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control form-control-solid" placeholder="Enter username" name="username"/>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control form-control-solid" placeholder="Enter password" name="password"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $('.btn-edit').click(function(e){
        e.preventDefault();

        var href = $(this).attr('href');

        $.ajax({
            url: href,
            method: "GET",
            success: function(result){
                $('#editUser').find('form').attr('action', href);

                $('#editUser').find('form').find('input[name="name"]').val(result.data.name);
                $('#editUser').find('form').find('input[name="username"]').val(result.data.username);

                $('#editUser').modal('show');
            }
        })
    })
</script>
@endsection
