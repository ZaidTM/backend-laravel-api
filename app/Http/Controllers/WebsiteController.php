<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Hash;
use Auth;
use Session;
use Illuminate\Support\Str;

class WebsiteController extends Controller
{
    public function home()
    {
        return view('website.index');
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                if (Auth::check()) {
                    return redirect(RouteServiceProvider::HOME);
                }

            } else {
                return redirect()->back()->with('error', 'Invalid Email or Password !');
            }
        } else {

            if (Auth::guard('web')->check()) {
                return redirect(RouteServiceProvider::HOME);

            } else {
                return view('website.login');
            }
        }
    }

    public function register()
    {
        return view('website.register');
    }

    public function saveuserrecord(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'phone' => 'required',
            'address' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        user::create($data);
        Session::flash('message', 'Successfully Registered.');
        return redirect()->route('login');
    }

    public function profile()
    {
        return view('website.users.profile');
    }

    public function updateprofile(Request $request)
    {
        $GetData = User::findOrFail(Auth::user()->id);

        $EmailCheck = user::where('email', $request->email)->where('id', '!=', $GetData->id)->count();
        if ($EmailCheck > 0) {
            Session::flash('error', 'This email is already taken.');
            return back();
        }

        if (isset($request->name)) {
            $GetData->name = $request->name;
        }

        if (isset($request->phone)) {
            $GetData->phone = $request->phone;
        }

        if (isset($request->address)) {
            $GetData->address = $request->address;
        }

        if (isset($request->email)) {
            $GetData->email = $request->email;
        }
        if (isset($request->password)) {

            $validator = Validator::make($request->all(), [
                'password' => 'required|string|min:8'
            ]);

            if ($validator->fails()) {
                Session::flash('error', 'Please Enter Valid Password !');
                return back();
            }
            $GetData->password = Hash::make($request->password);
        }

        $GetData->save();
        Session::flash('message', 'Successfully Updated !');
        return back();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route("/");
    }

}
