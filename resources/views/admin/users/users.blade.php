@extends('admin.layout.layout')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">ALL Users</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>email</th>
                            <th>status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user )
                        <tr>
                            <td>{{$user['id']}}</td>
                            <td>{{$user['name']}}</td>
                            <td>{{$user['email']}}</td>
                            <td>
                                @if($user ['status']==1)
                                <a   class="updateUserStatus" id=" user-{{ $user ['id']}}" user_id="{{ $user ['id']}}"
                               href="javascript:void(0)">
                               <i style="font-size:10px;" class="btn btn-outline-success" id="status-{{$user ['id']}}"  status="Active" >Active</i></a>
                                @else
                                <a   class="updateUserStatus"    id=" user-{{ $user ['id']}}" user_id="{{ $user ['id']}}"
                               href="javascript:void(0)">
                                 <i style="font-size: 10px;" class="btn btn-outline-danger" id="status-{{$user ['id']}}"  status="Inactive">Inactive</i></a>
                                @endif

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
