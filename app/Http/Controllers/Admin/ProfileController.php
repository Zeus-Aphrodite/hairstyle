<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $admin = \Auth::guard('admin')->user();
        return \view('admin.profile.edit', [
            'admin' => $admin,
        ]);
    }

    public function update(Request $request)
    {
        /** @var Admin $admin */
        $admin = \Auth::guard('admin')->user();
        $request->validate([
            'email' => 'required',
            'password' => 'required|confirmed',
        ]);
        $admin->email = (string)$request->get('email');
        $admin->password = \bcrypt($request->get('password'));
        $admin->save();
        \Session::flash('success', 'Your profile was successfully updated!');
        return \back();
    }
}
