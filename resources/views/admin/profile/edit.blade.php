@extends('admin.layout')

@section('content')
    <div class="page-title">
        <h3>Update admin credentials</h3>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="grid simple">
                <div class="grid-body no-border" style="padding-top: 20px">
                    <div class="col-md-8 col-sm-8 col-xs-8">
                        <form
                            method="POST"
                            action="{{ \route('admin.profile.update', ['admin' => $admin]) }}"
                        >
                            {!! \csrf_field() !!}
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <div class="controls">
                                    <input type="email" class="form-control" required name="email" value="{{ $admin->email ?? '' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Password</label>
                                <div class="controls">
                                    <input type="password" class="form-control" required name="password">
                                </div>
                                @if ($errorMessage = $errors->get('password'))
                                    <p class="error-message">{{ \head($errorMessage) }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="form-label">Password confirmation</label>
                                <div class="controls">
                                    <input type="password" class="form-control" required name="password_confirmation">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
