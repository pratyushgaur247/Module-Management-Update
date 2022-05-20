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
                         <div class="row">
                             <div class="col-md-6">
                                <h5 class="title font-bold"> {{ __('Role') }} </h5>
                             </div>
                             <div class="col-md-6 text-right">
                                @can('role-create')
                                    <a href="{{route('role.create')}}" class="btn addbtn"> <span class="mr-1"><i class="fa fa-plus-circle" aria-hidden="true"></i></span> Add Role</a>
                                @endcan
                            </div>
                         </div>
                        {{-- <form method="GET" action="{{url('/admin/users')}}">
                            <div class="row">
                               
                                <div class="col-md-2 align-self-center">
                                    <h5 class="title font-bold"> {{ __('Business Owners') }} </h5>
                                </div>

                                <div class="col-md-3 text-center">
                                    <div class="search-via">
                                        <input type="text" name="name" value="{{ app('request')->input('name') }}" class="form-control" placeholder="Search via Business Owner" autocomplete="off">
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
                                    
                                        <a href="{{url('/admin/users')}}" class="btn btn-secondary ml-3" data-toggle="tooltip" title="Reset"><i class="fa fa-refresh"></i></a>
                                    </div>
                                
                                    <a href="{{ url('/admin/users/create') }}" class="btn addbtn ml-3"><span class="mr-1"><i class="fa fa-plus-circle" aria-hidden="true"></i></span> Add Business Owner</a>
                                </div>
                            </div>
                        </form> --}}
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped db-table text-center">
                            <thead>
                                <tr>
                                    <th width="10%">S.No.</th>
                                    <th width="25%">Role</th>
                                    <th width="45%">permission</th>
                                    <th width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody id="searchDataTable">
                                @forelse($roles as $key => $role)
                                    <tr>
                                        <td> {{ $key+1 }} </td>
                                        <td> {{ $role['name'] ?? '' }} </td>
                                        <td>
                                            @if( count($role->permissions) > 0)
                                                @foreach ($role->permissions as $permission)
                                                    <span class="badge badge-info">{{$permission->name ?? '' }}</span>
                                                @endforeach
                                            @else
                                                <span class="badge badge-danger">{{ 'Not Defined' }}</span>
                                            @endif
                                        </td>
                                        <td class="action-icon">
                                            @can('role-edit')
                                                <div class="icon">
                                                    <a href="{{ url('/admin/role/' . $role->id . '/edit') }}" class="" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>
                                                </div>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="12" class="no-product">
                                            <div class="text-center mb-3">
                                                <img src="{{ asset('images/no-product1.png') }}" alt="icon">
                                                <h2 class="title-medium">Currently, There are no business owner found.</h2>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {!! $roles->appends(request()->query())->links() !!}
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

            var password_status = $('#password_status-'+id).val();
            var status = $('#status-'+id).val();

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
                        if(data.type == 'deactivate'){
                            statusHtml.html(' ');
                            
                            statusHtml.append('  <a href="javascript:;" class="status" data-name="unpublish" data-id="'+id+'" ><span class="badge badge-pill badge-danger p-2 m-1">Deactive</span></a>');
                            
                            $('#proxy-'+id).addClass("disabled");
                            
                            var row = '';
                            row += '<div class="alert alert-card alert-danger" role="alert">Business owner account has been Deactivated successfully.';
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
                            row += '<div class="alert alert-card alert-success" role="alert">Business owner account has been Activated successfully.';
                            row += '    <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>';
                            row += '</div>';
                            $('.success').html(' ');
                            $('.success').append(row);

                            setTimeout(function(){
                                $('.alert-success').css('display', 'none')
                                $('.alert-danger').css('display', 'none')
                            }, 4000);
                            
                            if(password_status == '1' && status == '1'){
                                $('#proxy-'+id).removeClass("disabled");
                            }
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
                // title: 'Delete',
                // text:  'You want to delete business owner',
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
