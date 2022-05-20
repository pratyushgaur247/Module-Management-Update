@extends('dashboard.base')
@section('content')
<style>
label.error{
    color: red;
}
</style>
<div class="container-fluid">
    <div class="wrapper">
        @include('flash')
        {!!
            Form::model($role,[
                'route' => $role->exists ? ['role.update',$role->id] : ['role.store'],
                'method' => $role->exists ? 'PUT' : 'POST',
                'files' => true,
            ])    
        !!}
            @csrf
            <div class="card">
                <div class="card-header">
                    <h2>Role</h2>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Role Name</label>
                        <input type="text" class="form-control" name="name" value="{{  $role['name'] ?? '' }}" {{ $role->exists ? 'readonly' : '' }}>
                        @error('name')
                            <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Assign Permission</label>
                        <select class="form-control select2" name="permission[]" multiple="" >
                            @foreach ($allPermission as $permission)
                            
                                @if($role->guard_name == 'admin' && $permission->guard_name == 'admin')
                                    <option value="{{$permission->id}}" 
                                        @if( count($role->permissions ) > 0) 
                                        @foreach ($role->permissions as $asignPermission)
                                            {{ $permission->id == $asignPermission->id ? 'selected' : '' }}
                                        @endforeach
                                        @endif
                                        >{{ $permission->name ?? '' }}</option>
                                @elseif($permission->guard_name == 'web')
                                    <option value="{{$permission->id}}" 
                                    @if( count($role->permissions ) > 0) 
                                    @foreach ($role->permissions as $asignPermission)
                                        {{ $permission->id == $asignPermission->id ? 'selected' : '' }}
                                    @endforeach
                                    @endif>{{ $permission->name ?? '' }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="">
                        <button class="btn addbtn">Submit</button>
                        <a href="" class="btn btn-light">Reset</a>
                    </div>
                </div>
            </div>
        {{ Form::close() }}
	</div>
</div>
@endsection
@section('javascript')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

<script>
        $(document).ready(function() {
            $('.select2').select2({
                closeOnSelect: false
            });
        });
</script>

@endsection
