<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;

class AdministrationController extends Controller {

	public function __construct() {
		if (Auth::check()) {
			if (!Auth::user()->isAdministrator()) {
				return redirect()->to('/');
			}
		}		
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('administration/index');
	}

	public function users() {
		return view('administration/users');
	}

}
