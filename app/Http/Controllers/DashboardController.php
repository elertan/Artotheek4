<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use Input;
use Validator;
use Hash;
use App\User;
use App\UserPrivelege;

class DashboardController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('auth');
	}

	/**
	 * Shows the default page.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Auth::check()) {
			return view('dashboard/index');
		} else {
			return redirect()->to('dashboard/login');
		}
	}

	public function login() {
		if (Auth::check()) {
			return redirect()->to('dashboard');
		} else {
			return view('dashboard/login');
		}
	}

	public function loginSubmit() {
		$input = Input::all();
		$email = $input['email'];
		$password = $input['password'];

		if (Auth::attempt(array('email' => $email, 'password' => $password), isset($input['remember']))) {
		    return redirect()->to('dashboard');
		} else {
			return redirect()->back()->withErrors(array('Je email/wachtwoord komt niet bij ons voor.'));
		}
	}

	public function register() {
		return view('dashboard/register');
	}

	public function registerSubmit() {

		$input = Input::all();

		if ($input['password'] != $input['password_confirmation']) {
			return redirect()->back()->withErrors('Wachtwoorden komen niet overeen!');
		}

		$validator = Validator::make(
			$input,
		    array(
		        'name' => 'required',
		        'password' => 'required|min:8',
		        'email' => 'required|email|unique:users'
		    )
		);

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator->errors());
		}

		$user = new User();
		$user->name = $input['name'];
		$user->email = $input['email'];
		$user->password = Hash::make($input['password']);
		$user->priveleges = UserPrivelege::User;

		$user->save();

		return redirect()->to('dashboard/login')->with('message', 'Account aangemaakt!');
	}

	public function logout() {
		if (Auth::check()) {
			Auth::logout();
		}
		return redirect()->to('/');
	}

}
