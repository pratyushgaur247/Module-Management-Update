<div class="row">
    <div class="col-md-12">
        @foreach (['success','warning','danger','primary'] as $session)
            @if(Session::has($session))
                <div class="alert alert-card alert-{{$session}}" role="alert">{{--<strong class="text-capitalize">{{$session}}!</strong>--}} {!! Session::get($session) !!}
                    <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
            @endif
        @endforeach
    </div>
</div>