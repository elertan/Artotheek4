<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;

class GalleryController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('gallery/index');
	}

	public function create() {
		if (Auth::check() && Auth::user()->isStudent()) {
			return view('gallery/create');
		} else {
			return redirect()->to('/');
		}
	}

}
