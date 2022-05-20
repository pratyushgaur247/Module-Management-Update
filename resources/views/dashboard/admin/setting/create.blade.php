@extends('dashboard.base')
@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">
		@include('flash') {{--session message--}}
		<form method="POST" action="{{ route('setting.store') }}" autocomplete="off">
			@csrf
			<div class="row">
				<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col-md-6">
									<h5> {{ __('Social Links') }}</h5>
								</div>
								<div class="col-md-6 text-right">
									
								</div>
							</div>
						</div>
						<div class="card-body">
								<input type="hidden" name="hidden_id" value="{{ isset($settInfo->id) ? $settInfo->id : '' }}">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Facebook <span class="text-danger">*</span></label>
											<input type="text" name="facebook" class="form-control" value="{{ isset($settInfo->facebook) ? $settInfo->facebook : 'https://www.facebook.com/' }}">
											@error('facebook')
												<div class="text text-danger">{{ $message }}</div>
											@enderror
										</div>
										<div class="form-group">
											<label>Twitter <span class="text-danger">*</span></label>
											<input type="text" name="twitter" class="form-control" value="{{ isset($settInfo->twitter) ? $settInfo->twitter : 'https://twitter.com/' }}">
											@error('twitter')
												<div class="text text-danger">{{ $message }}</div>
											@enderror
										</div>
										<div class="form-group">
											<label>Instagram <span class="text-danger">*</span></label>
											<input type="text" name="instagram" class="form-control" value="{{ isset($settInfo->instagram) ? $settInfo->instagram : 'https://www.instagram.com/' }}">
											@error('instagram')
												<div class="text text-danger">{{ $message }}</div>
											@enderror
										</div>
										<div class="form-group">
											<label>Linkedin <span class="text-danger">*</span></label>
											<input type="text" name="linkedin" class="form-control" value="{{ isset($settInfo->linkedin) ? $settInfo->linkedin : 'https://www.linkedin.com/' }}">
											@error('linkedin')
												<div class="text text-danger">{{ $message }}</div>
											@enderror
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<div class="card">
						<div class="card-header">
							<h5> {{ __('Contact Information') }} </h5>
						</div>
						<div class="card-body">
								<input type="hidden" name="hidden_id" value="{{ isset($settInfo->id) ? $settInfo->id : '' }}">
								<div class="row">
									<div class="col-md-12">

										<div class="form-group">
											<label>Phone Number <span class="text-danger">*</span></label>
											<input type="text" name="phone" maxlength="10" min="1" class="form-control" value="{{ isset($settInfo->phone) ? $settInfo->phone : old('phone') }}">
											@error('phone')
												<div class="text text-danger">{{ $message }}</div>
											@enderror
										</div>

										<div class="form-group">
											<label>Email <span class="text-danger">*</span></label>
											<input type="text" name="email" class="form-control" value="{{ isset($settInfo->email) ? $settInfo->email : old('email') }}">
											@error('email')
												<div class="text text-danger">{{ $message }}</div>
											@enderror
										</div>

										<div class="form-group">
											<label>Address <span class="text-danger">*</span></label>
											<input type="text" name="address" class="form-control" value="{{ isset($settInfo->address) ? $settInfo->address : old('address') }}">
											@error('address')
												<div class="text text-danger">{{ $message }}</div>
											@enderror
										</div>
										
									</div>
								</div>
								<div class="form-group text-right">
									<button class="btn addbtn" type="submit">Submit</button>
								</div>
						</div>
					</div>
				</div>
			</div>
		</form>
    </div>
</div>
@endsection
@section('javascript')
@endsection