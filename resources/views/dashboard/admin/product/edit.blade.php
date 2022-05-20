@extends('dashboard.base')
@section('content')

<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6 col-7">
                                <h5 class="card-title mb-0">Edit Product</h5>
                            </div>
                            <div class="col-md-6 col-5">
                                <div class="text-right">
                                    <a href="{{ auth()->guard('admin')->check() ? url('/admin/product') : url('/products') }}" class="btn addbtn">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body"> 
                        <form method="POST" action="{{ auth()->guard('admin')->check() ?  route('product.update',[$product->id]) :   route('products.update',[$product->id])  }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card">
                                <div class="card-header"><strong>Product Detail</strong></div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Title <span class="text-danger">*</span></label>
                                                <input type="text" name="title" value="{{ $product->title ?? old('title') }}" class="form-control form-control-solid" placeholder="Enter Title"/>
                                                @error('title')
                                                    <div class="text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">SKU <span class="text-danger">*</span></label>
                                                <input type="text" name="sku" maxlength="15" value="{{ $product->sku ?? old('sku') }}" class="form-control form-control-solid" placeholder="Enter SKU"/>
                                                @error('sku')
                                                    <div class="text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Description <span class="text-danger">*</span></label>
                                                <textarea class="form-control" rows="5" name="description">{{ $product->description ?? old('description') }}</textarea>
                                                @error('description')
                                                    <div class="text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Price <span class="text-danger">*</span></label>
                                                <input type="text" name="price" maxlength="10" value="{{ $product->price ?? old('price') }}" class="form-control form-control-solid" placeholder="Enter Price"/>
                                                @error('price')
                                                    <div class="text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Available Stock <small>(in numbers)</small> <span class="text-danger">*</span></label>
                                                <input type="number" name="quantity" maxlength="7" value="{{ $product->quantity ?? old('quantity') }}" class="form-control form-control-solid" placeholder="Enter Stock"/>
                                                @error('quantity')
                                                    <div class="text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Category <span class="text-danger">*</span></label>
                                                <div class="custom-dropdown">
                                                    <select name="category" class="form-control">
                                                        <option value="">Select</option>
                                                        @forelse($allCategory as $catKey => $catVal)
                                                            <option value="{{$catVal->id}}" {{ $product->category == $catKey ? 'selected' : '' }}>{{$catVal->name}}</option>
                                                        @empty
                                                            <option value="">No Category</option>
                                                        @endforelse
                                                    </select>
                                                    <i class="fa fa-caret-down down" aria-hidden="true"></i>
                                                </div>
                                                @error('category')
                                                    <div class="text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Upload Product Image <span class="text-danger">*</span></label>
                                                <span class="dragBox">
                                                    Click to upload <i class="fa fa-upload ml-2" aria-hidden="true"></i><br>
                                                    <input type="file" value="{{ old('image') }}" {{--onChange="dragNdrop(event)"  ondragover="drag()" ondrop="drop()"--}} id="uploadFile" name="image">
                                                </span>
                                                <span id="fileName"></span>
                                                @error('image')
                                                    <div class="text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                @if($product->getFirstMediaUrl('image'))
                                                    <img src="{{$product->getFirstMediaUrl('image')}}" / width="75" height="75">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <input type="submit" class="btn addbtn" value="Submit">
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
<script type="text/javascript">
    /* ==================== APPEND INPUT SELECTED FILE NAME ==================== */
    $('input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        $('#fileName').text('The file "' + fileName +  '" has been selected.');
    });
</script>
@endsection