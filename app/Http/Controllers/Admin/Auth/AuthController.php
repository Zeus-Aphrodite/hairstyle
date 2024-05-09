<?php namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = 'admin';

    protected $redirectAfterLogout = 'admin';

    protected $loginView = 'auth.admin-login';

    protected $guard = 'admin';

    protected function guard()
    {
        return \Auth::guard('admin');
    }

    public function showLoginForm()
    {
        return \view('admin.auth.login');
    }

    public function authenticate(Request $request)
    {
        return $this->login($request);
    }

    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        // XXX to suppress phpstorm warning
        $request ? null : false;
        return \redirect(\route('admin.login.form'));
    }
}
