@extends('frontend.frontBase')
@section('content')
	<section class="common-sec1 bgimg" style="background-image: url(frontend/assets/images/bg1.jpg);">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="policy-content">
						<h2 class="text-center">{{ $pageContent->title ?? ''}}</h2>
					</div>
				</div>
                <div class="col-md-12">
					@if($pageContent->getFirstMediaUrl('image', 'thumb'))
                    	<img src="{{$pageContent->getFirstMediaUrl('image', 'thumb')}}" class="w-100">
                    @endif
				</div>
				<div class="col-md-12">
					<div class="policy-content">
						{!!$pageContent->content ?? '' !!}
					</div>
                </div>
			</div>
		</div>
	</section>
@endsection
@section('javascript')
@endsection