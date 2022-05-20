@extends('dashboard.base')
@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">
        @include('flash') {{--session message--}}
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Emails Templates</h5>
                            </div>
                            <div class="col-md-6 text-right">
                                {{--<a href="{{ route('mail.create') }}" class="btn addbtn"><i class="fa fa-plus-circle"></i> Add Template</a>--}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-sm table-striped">
                            <thead>
                                <tr>
                                    <th width="30%">Name</th>
                                    <th width="40%">Subject</th>
                                    <th class="text-center" width="30%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($emailTemplates as $mail)
                                <tr>
                                    <td>{{ $mail->name ?? '' }}</td>
                                    <td>{{ $mail->subject ?? '' }}</td>
                                    <td class="action-icon">
                                        {{--
                                            <a href="{{ route('prepareSend', ['id' => $mail->id] ) }}" class="btn btn-warning">Send</a>
                                            <a href="{{ url('/admin/mail/' . $mail->id) }}" class="btn btn-primary">View</a>--}}
                                        <div class="icon">
                                            <a href="{{ url('/admin/mail/'.$mail->id.'/edit') }}" class="" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>
                                        </div>
                                        {{--<form action="{{ route('mail.destroy', $mail->id ) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger">Delete</button>
                                        </form>--}}
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <h3>Add your first email tempalte.</h3>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $emailTemplates->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
@endsection
