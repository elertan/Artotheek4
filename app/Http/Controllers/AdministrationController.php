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
	public function index() {
        if (Auth::check() && Auth::user()->isAdministrator()) {
            return view('administration/index');
        } else {
            return redirect()->to('/')->withErrors(array('Je hebt geen toestemming deze pagina te bekijken.'));
        }
	}

	public function users() {
        if (Auth::check() && Auth::user()->isAdministrator()) {
            return view('administration/users');
        } else {
            return redirect()->to('/')->withErrors(array('Je hebt geen toestemming deze pagina te bekijken.'));
        }
	}

}
