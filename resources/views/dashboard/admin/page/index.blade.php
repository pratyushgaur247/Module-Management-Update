@extends('dashboard.base')
@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        @include('flash') {{--session message--}}
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card db-table">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6 col-5">
                                <h5 class="title">{{ __('Pages') }}</h5>
                            </div>
                            <div class="col-md-6 col-7 text-right">
                                <a href="{{ auth()->guard('admin')->check() ?  route('page.create') :  route('pages.create')  }}" class="btn addbtn"><span class="mr-1"><i class="fa fa-plus-circle" aria-hidden="true"></i></span> Add Page</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-sm table-striped db-table text-center">
                            <thead>
                                <tr>
                                    <th class="text-center">S.No.</th>
                                    <th class="text-center">Title</th>
                                    <th class="text-center">Image</th>
                                    @can('cms-status')<th class="text-center">Status</th>@endcan
                                    <th class="text-center">Created At</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="searchDataTable">
                                @forelse ($pages as $key => $page)
                                    <tr>
                                        <td class="text-center">{{$key+1}}</td>
                                        <td class="text-center">
                                            {{ $page->title ?? '' }}
                                        </td>
                                        <td class="text-center">
                                            @if($page->getFirstMediaUrl('image', 'thumb'))
                                                <img src="{{$page->getFirstMediaUrl('image', 'thumb')}}" width="50" height="50" style="border-radius: 5px;">
                                            @else
                                                {{'NA'}}
                                            @endif
                                        </td>
                                        @can('cms-status')
                                        <td class="text-center status-panel">
                                            @if($page->status == '1')
                                                <a href="javascript:;" class="status" data-id="{{$page->id}}" data-name="0">
                                                    <span class="badge badge-pill badge-success m-2">Active</span>
                                                </a>
                                            @else
                                                <a href="javascript:;" class="status" data-id="{{$page->id}}" data-name="1">
                                                    <span class="badge badge-pill badge-danger m-2">Deactive</span>
                                                </a>
                                            @endif
                                        </td>
                                        @endcan
                                        <td class="text-center">
                                            {{$page->created_at->format('d M Y, h:i A') ?? ''}}
                                        </td >
                                        <td class="action-icon">
                                            @can('cms-edit')
                                            <a href="{{ auth()->guard('admin')->check() ? url('/admin/page'.'/'.$page->id.'/edit') : url('/pages'.'/'.$page->id.'/edit')}}" class="btn btn-light" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                            @endcan
                                            @can('cms-view')
                                                <a href="{{ auth()->guard('admin')->check() ?  url('/page/'.$page->slug) : url('/pages/'.$page->slug)}}" class="btn btn-light" data-toggle="tooltip" title="" data-original-title="Visit Page" target="_blank"><i class="fa fa-eye"></i></a>
                                            @endcan
                                            @can('cms-destroy')
                                            <div class="icon">
                                                <form action="{{ auth()->guard('admin')->check() ? route('page.destroy', $page->id ) : route('pages.destroy', $page->id ) }}" method="POST">
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
                                    <tr>
                                        <td colspan="13" class="text-center no-product">
                                            <div class="text-center mb-3">
                                                <img src="{{ asset('images/no-product1.png') }}" alt="icon">
                                                @if(auth()->guard('admin')->check() && Request::segment(1) == 'admin')
                                                    <h2 class="title-medium pb-0">No Page found</h2>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                        {!! $pages->appends(request()->query())->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
    });
</script>
<script type="text/javascript">
    //Status Change Activate or Deactivate Code
    $(document).on('click','.delete',function(){
        var data = $(this).closest('.icon').find('.deleteSubmit');
        swal({
            // title: 'Are you sure?',
            title: 'Are you sure?',
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
                 data.trigger('click');
            });

    });
</script>
<script>
    //Status Change Activate or Deactivate Code
    $(document).on('click','.status',function(){
        var status =$(this).attr('data-name');
        var id = $(this).attr('data-id');
        var statusPanelHtml = $(this).closest('tr').find('.status-panel');
        swal({
            title: status == '0' ? "Do you want to Deactive?" : 'Do you want to Active?',
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
                url:'/admin/page/status',
                method: 'post',
                data: {_token:"{{csrf_token()}}",id:id,status:status},
                success:function(data){
                    console.log(data);
                    if(data.status == 'success'){
                        if(data.statusChange == '1'){
                            //deactivate code
                            var row = '';
                            row += '<a href="javascript:;" class="status" data-id="'+id +'" data-name="1">';
                            row += '    <span class="badge badge-pill badge-danger m-2">Deactive</span>';
                            row += '</a>';
                            statusPanelHtml.html(' ');
                            statusPanelHtml.append(row);
                        }
                        if(data.statusChange == '0'){
                            //activated code
                            var row = '';
                            row +='<a href="javascript:;" class="status" data-id="'+id+'" data-name="0">';
                            row +='     <span class="badge badge-pill badge-success m-2">Active</span>';
                            row +='</a>';
                            statusPanelHtml.html(' ');
                            statusPanelHtml.append(row);
                        }
                    }
                }
            });
        });
    });
</script>
@endsection