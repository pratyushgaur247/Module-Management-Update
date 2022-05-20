@extends('dashboard.errorBase')

@section('content')

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="clearfix">
            <h1 class="float-left display-3 mr-4">401</h1>
            <h4 class="pt-3">Unauthorized</h4>
            <p class="text-muted">You are not authenticated to visit that page.</p>
            <a href="{{url('/home')}}" class="btn btn-info" {{--style="background:#3c4b64 !important;"--}}>Home</a>
          </div>
          <div class="input-prepend input-group">
            <div class="input-group-prepend"><span class="input-group-text">
                <svg class="c-icon">
                  <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-magnifying-glass"></use>
                </svg></span>
            </div>
              {{-- <input class="form-control" id="prependedInput" size="16" type="text" placeholder="What are you looking for?"><span class="input-group-append">
              <button class="btn btn-info" type="button">Search</button></span> --}}
            
          </div>
        </div>
      </div>
    </div>

@endsection

@section('javascript')

@endsection