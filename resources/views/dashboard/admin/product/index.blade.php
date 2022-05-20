@extends('dashboard.base')
@section('content')
<style type="text/css">
    button.disabled {
        pointer-events: none;
        color: #ccc;
    }
</style>
<div class="container-fluid">
    <div class="animated fadeIn">
        @include('flash') {{--session message--}}
        <div class="col-md-12 success"></div>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-8 col-5">
                                <!-- <i class="fa fa-align-justify"></i> --><h5 class="title">{{ __('Products') }}</h5>
                            </div>
                            <div class="col-md-4 col-7 text-right">
                                <a href="{{ auth()->guard('admin')->check() && Request::segment(1) == 'admin' ? url('/admin/product/create') : url('/products/create') }}" class="btn addbtn ml-0"><span class="mr-1"><i class="fa fa-plus-circle" aria-hidden="true"></i></span> Add Product</a>
                            </div>
                        </div>
                        <form method="GET" action="{{auth()->guard('admin')->check() && Request::segment(1) == 'admin' ? url('/admin/product') : url('/products') }}">
                            <div class="row search-filter">
                                <div class="col-md-1">

                                </div>
                                <div class="col-md-4 text-center">
                                    <div class="search-via">
                                        <input type="text" name="title" value="{{ app('request')->input('title') }}" class="form-control" placeholder="Search via Title" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-4 text-center">
                                    <div class="search-via">
                                        <input type="text" name="sku" value="{{app('request')->input('sku')}}" class="form-control" placeholder="Search via SKU" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="search-via">
                                        <button type="submit" class="btn btn-secondary" data-toggle="tooltip" title="Search"><i class="fa fa-search"></i></button>
                                    
                                        <a href="{{auth()->guard('admin')->check() && Request::segment(1) == 'admin' ? url('/admin/product') : url('/products')}}" class="btn btn-secondary ml-3" data-toggle="tooltip" title="Reset"><i class="fa fa-refresh"></i></a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped db-table text-center">
                            <thead>
                                <tr>
                                    <th class="text-center">S.No.</th>
                                    <th>Title</th>
                                    <th>SKU</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Created At</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="searchDataTable">
                                @forelse($allProduct as $key => $product)
                                <tr>
                                    <td class="text-center">{{ $key+1 ?? '' }}</td>
                                    <td>{{ $product->title ?? '' }}</td>
                                    <td>{{ $product->sku ?? '' }}</td>
                                    <td><b>$</b>{{ number_format($product->price ?? '') }}.00</td>
                                    <td>
                                        {{ $product->quantity ?? '' }}
                                        @if($product->unit == 1)
                                            {{' KG'}}
                                        @else
                                            {{' Pounds'}}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($product->status == '0')
                                            <a href="javascript:;" class="status" data-id="{{$product->id}}" data-name="unpublish"><span class="badge badge-pill badge-danger btn-status">Deactive</span></a>
                                        @else
                                            <a href="javascript:;" class="status" data-id="{{$product->id}}" data-name="publish"><span class="badge badge-pill badge-success btn-status">Active</span></a>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $product->created_at->toDateString() ?? '' }}</td>
                                    <td class="action-icon">
                                        @can('product-edit')
                                        <div class="icon">
                                            <a href="{{ auth()->guard('admin')->check() ? url('/admin/product/' . $product->id . '/edit') :  url('/products/' . $product->id . '/edit') }}" class="" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>
                                        </div>
                                        @endcan
                                        @can('product-destroy')
                                        <div class="icon">
                                            <form action="{{ auth()->guard('admin')->check() ?  route('product.destroy', $product->id ) : route('products.destroy', $product->id ) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <a href="javascript:;" class="delete" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>
                                                <button type="submit" class="deleteSubmit d-none"><i class="fa fa-trash"></i></button>
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
                                                <h2 class="title-medium pb-0">No Product Found.</h2>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @if($allProduct != [])
                            {!! $allProduct->appends(request()->query())->links() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')

<script type="text/javascript">
    /* === HIDE SUCCESS AND ERROR MESSAGE === */
    $( document ).ready(function() {
        setTimeout(function(){
            $('.alert-success').css('display', 'none')
            $('.alert-danger').css('display', 'none')
        }, 4000);
    });

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
                url: '/admin/product/status/'+id,
                method: 'GET',
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    if(data.type == 'deactivate'){
                        statusHtml.html(' ');
                        statusHtml.append('  <a href="javascript:;" class="status" data-name="unpublish" data-id="'+id+'" ><span class="badge badge-pill badge-danger p-2 m-1">Deactive</span></a>');

                        var row = '';
                        row += '<div class="alert alert-card alert-danger" role="alert">Product has been Deactivated successfully.';
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
                        row += '<div class="alert alert-card alert-success" role="alert">Product has been Activated successfully.';
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
    

    /* ===== DELETE PRODUCT CONFIRM POPUP ===== */
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