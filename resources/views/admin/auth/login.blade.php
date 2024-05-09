@php #
/**
 * @var Illuminate\Support\ViewErrorBag|\Illuminate\Support\Collection $errors
 */
@endphp
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8" />
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="{{ \asset('css/admin/bootstrap.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ \asset('css/admin/admin.css') }}" rel="stylesheet" type="text/css" />
    </head>

    <body class="error-body no-top">
        <div class="container">
            <div class="row login-container">
                <div class="col-md-5">
                    <br>
                    <form action="{{ \route('admin.login.submit') }}" class="login-form validate" method="post">
                        {{ \csrf_field() }}
                        <div class="row">
                            <div class="form-group col-md-10">
                                <label for="email" class="form-label">Email</label>
                                <input
                                    id="email"
                                    name="email"
                                    class="form-control {{ $errors->has('email') ? 'error' : '' }}"
                                    type="email"
                                    required
                                >
                                @if ($errorMessage = $errors->get('email'))
                                    <p class="error-message">{{ \head($errorMessage) }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-10">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" name="password" class="form-control" type="password" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="control-group col-md-10">
                                <div class="checkbox checkbox check-success">
                                    <input id="remember" type="checkbox" value="1">
                                    <label for="remember">Keep me reminded</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <button class="btn btn-primary btn-cons pull-right" type="submit">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
