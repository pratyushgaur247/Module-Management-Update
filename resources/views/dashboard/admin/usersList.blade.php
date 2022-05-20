@extends('dashboard.base')
@section('content')
<style type="text/css">
    a.disabled {
        pointer-events: none;
        color: #ccc!important;
    }
</style>
<div class="container-fluid">
    <div class="animated fadeIn">
        @include('flash') {{--session message--}}
        <div class="col-md-12 success"></div>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card db-table">
                    <div class="card-header">
                        <form method="GET" action="{{Request::segment(1) == 'admin' ? url('/admin/users') : url('/users')}}">
                            <div class="row">
                                <div class="col-md-2 align-self-center">
                                    <h5 class="title font-bold"> {{ __('Users') }} </h5>
                                </div>

                                <div class="col-md-3 text-center">
                                    <div class="search-via">
                                        <input type="text" name="name" value="{{ app('request')->input('name') }}" class="form-control" placeholder="Search via Name" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-3 text-center">
                                    <div class="search-via">
                                        <input type="text" name="email" value="{{ app('request')->input('email') }}" class="form-control" placeholder="Search via Email" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-4 text-right align-self-center add-owner">
                                    <div class="search-via">
                                        <button type="submit" class="btn btn-secondary" data-toggle="tooltip" title="Search"><i class="fa fa-search"></i></button>                                    
                                        <a href="{{ Request::segment(1) == 'admin' ? url('/admin/users') : url('/users') }}" class="btn btn-secondary ml-3" data-toggle="tooltip" title="Reset"><i class="fa fa-refresh"></i></a>
                                    </div>
                                
                                    <a href="{{ Request::segment(1) == 'admin' ? url('/admin/users/create') : url('/users/create') }}" class="btn addbtn ml-3"><span class="mr-1"><i class="fa fa-plus-circle" aria-hidden="true"></i></span> Add User</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped db-table text-center">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="searchDataTable">
                                @forelse($users as $key => $user)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $user->name ?? '' }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->status == '0')
                                            <a href="javascript:;" class="status" data-id="{{$user->id}}" data-name="unpublish"><span class="badge badge-danger m-1">Deactive</span></a>
                                        @else
                                            <a href="javascript:;" class="status" data-id="{{$user->id}}" data-name="publish"><span class="badge badge-success m-1">Active</span></a>
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at->toDateString() }}</td>
                                    {{--<td>
                                        <a href="{{ url('/users/' . $user->id) }}" class="btn btn-block btn-primary">View</a>
                                    </td>--}}
                                    <td class="action-icon">
                                        @can('user-edit')
                                        <div class="icon">
                                            <a href="{{ Request::segment(1) == 'admin' ? url('/admin/users/' . $user->id . '/edit') : url('/users'.'/'.$user->id.'/edit') }}" class="btn btn-light" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>
                                        </div>
                                        @endcan
                                        @can('user-destroy')
                                        <div class="icon">
                                            <form action="{{ Request::segment(1) == 'admin' ? url('admin/users/'.$user->id) :  url('/users'.'/'.$user->id)  }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <a href="javascript:;" class="delete btn btn-light" data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o"></i></a>
                                                <button type="submit" class=" deleteSubmit d-none" data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o"></i></button>
                                            </form>
                                        </div>
                                        @endcan
                                    </td>
                                </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="12" class="no-product">
                                            <div class="text-center mb-3">
                                                <img src="{{ asset('images/no-product1.png') }}" alt="icon">
                                                <h2 class="title-medium">Currently, There are no user found.</h2>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {!! $users->appends(request()->query())->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')

<script type="text/javascript">
    $( document ).ready(function() {
        setTimeout(function(){
            $('.alert-success').css('display', 'none')
            $('.alert-danger').css('display', 'none')
        }, 4000);
    });
</script>

<script>
    /* ===== Status Active Deactive Start ===== */
    $(document).on('click','.status',function(){
        var id = $(this).attr('data-id');
        var name = $(this).attr('data-name');
        var statusHtml = $(this).parent();

        swal({
            // title: 'Are you sure?',
            title: name == 'publish' ? "Do you want to Deactive?" : 'Do you want to Active?',
            // text:  name == "publish" ? 'Topic will be visible in the Topic\'s list but it won\'t be available for adding to the tests.' : 'Topic will be available to be added to the tests.',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0CC27E',
            cancelButtonColor: '#FF586B',
            confirmButtonText: 'Yes, Confirm!',
            cancelButtonText: 'No, Cancel!',
            confirmButtonClass: 'btn-medium yes',
            cancelButtonClass: 'btn-medium no',
            buttonsStyling: true
        }).then(function () {
            $.ajax({
                url: '/admin/status/'+id,
                method: 'GET',
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    alert(data.type)
                    if(data.type == 'deactivate'){
                        statusHtml.html(' ');
                        
                        statusHtml.append('  <a href="javascript:;" class="status" data-name="unpublish" data-id="'+id+'" ><span class="badge badge-pill badge-danger p-2 m-1">Deactive</span></a>');
                        
                        var row = '';
                        row += '<div class="alert alert-card alert-danger" role="alert">User account has been Deactivated successfully.';
                        row += '    <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>';
                        row += '</div>';
                        $('.success').html(' ');
                        $('.success').append(row);
                        setTimeout(function(){
                            $('.alert-success').css('display', 'none')
                            $('.alert-danger').css('display', 'none')
                        }, 4000);
                    }else{
                        statusHtml.html(' ');
                        
                        statusHtml.append('  <a href="javascript:;" class="status" data-name="publish" data-id="'+id+'" ><span class="badge badge-pill badge-success p-2 m-1">Active</span></a>');
                        
                        var row = '';
                        row += '<div class="alert alert-card alert-success" role="alert">User account has been Activated successfully.';
                        row += '    <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>';
                        row += '</div>';
                        $('.success').html(' ');
                        $('.success').append(row);

                        setTimeout(function(){
                            $('.alert-success').css('display', 'none')
                            $('.alert-danger').css('display', 'none')
                        }, 4000);

                    }
                }
            });
        },
        function (dismiss) {
        
        });
    });
    /* ===== Status Active Deactive End ===== */
</script>

<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
    });
</script>

<script>
    $(document).on('click','.delete',function(){
        var data = $(this).closest('.icon').find('.deleteSubmit');
        swal({
            title: 'Are you sure?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0CC27E',
            cancelButtonColor: '#FF586B',
            confirmButtonText: 'Yes, Delete!',
            cancelButtonText: 'No, Cancel!',
            confirmButtonClass: 'btn-medium yes',
            cancelButtonClass: 'btn-medium no',
            buttonsStyling: true
        }).then(function () {
            data.trigger('click');
        });
    })
</script>
@endsection
