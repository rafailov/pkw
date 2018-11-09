<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Auth;
use \Validator;
use \Redirect;

class AdminController extends Controller
{
    public function returnLoginView()
    {
        return view('admin.login');
    }

    public function postLogin()
    {
        $rules = array(
            'name' => 'required',
            'password' => 'required|alphaNum|min:3'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)
                ->withInput(Input::except('password'));
        }

        $userdata = array(
            'name' => Input::get('name'),
            'password' => Input::get('password')
        );
        $remember = false;
        if (Input::has('remember')) $remember = true;

        if (Auth::attempt($userdata)) {

            return redirect('admin');

        } else {
            return Redirect::back()->withInput(Input::except('password'));
        }
    }
}
