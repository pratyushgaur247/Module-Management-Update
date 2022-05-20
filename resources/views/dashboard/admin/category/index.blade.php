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
                                <!-- <i class="fa fa-align-justify"></i> --><h5 class="title">{{ __('Category') }}</h5>
                            </div>
                            <div class="col-md-4 col-7 text-right">
                                @can('category-create')<a href="{{ auth()->guard('admin')->check() ? url('/admin/category/create') : url('/category/create') }}" class="btn addbtn ml-0"><span class="mr-1"><i class="fa fa-plus-circle" aria-hidden="true"></i></span> Add Category</a> @endcan
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped db-table text-center">
                            <thead>
                                <tr>
                                    <th class="text-center">S.No.</th>
                                    <th>Title</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="searchDataTable">
                                @forelse($allCategory as $key => $cat)
                                <tr>
                                    <td class="text-center">{{ $key+1 ?? '' }}</td>
                                    <td>{{ $cat->name ?? '' }}</td>
                                    <td class="action-icon">
                                        <div class="icon">
                                            @can('category-edit')
                                            <a href="{{ auth()->guard('admin')->check() ?  url('/admin/category/' . $cat->id . '/edit')  : url('/category/' . $cat->id . '/edit')  }}" class="" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="13" class="text-center no-product">
                                        <div class="text-center mb-3">
                                            <img src="{{ asset('images/no-product1.png') }}" alt="icon">
                                            @if(auth()->guard('admin')->check() && Request::segment(1) == 'admin')
                                                <h2 class="title-medium pb-0">No Category Found.</h2>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @if($allCategory != [])
                            {!! $allCategory->appends(request()->query())->links() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')

@endsection
