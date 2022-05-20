@extends('dashboard.base')
@section('content')
<div class="container-fluid">
    @include('flash') {{--session message--}}
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>{{ 'Add Page' }}</h5>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ auth()->guard('admin')->check() ? route('page.index') : route('pages.index') }}" class="btn addbtn">Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ auth()->guard('admin')->check() ? route('page.store') : route('pages.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label>Page Title <span class="text-danger">*</span></label>
                                    <input name="title" value="{{ old('title') }}" class="form-control" type="text" placeholder="Enter Page Title">
                                    @error('title')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label>Feature Image</label>
                                    <input type="file" name="image" value="{{ old('image') }}" class="form-control">
                                    @error('image')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label>Content <span class="text-danger">*</span></label>
                                    <textarea name="content" placeholder="Enter Your Page Content" class="form-control content" cols="30" rows="10">{{ old('content') }}</textarea>
                                    @error('content')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <button class="btn addbtn" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script>
    CKEDITOR.replace('content');
</script>
@endsection