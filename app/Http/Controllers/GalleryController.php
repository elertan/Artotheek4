<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use Input;
use Validator;
use App\Artwork;

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
			return redirect()->to('/')->withErrors('Als gebruiker mag je niets insturen.');
		}
	}
    
    public function createSubmit() {
        if (Auth::check() && Auth::user()->isStudent()) {
			
            $input = Input::all();
            $image = Input::file('picture');
            
            $validator = Validator::make(
                $input,
                array(
                    'name' => 'min:5',
                    'description' => 'min:5'
                )
            );
            
            if ($validator->fails()) {
                return redirect()->to('/gallery/create')->withErrors($validator->errors());
            } else {
                
                $extensions = array('png', 'jpg', 'jpeg', 'gif');
                
                $imageExtension = $image->getClientOriginalExtension();
                
                if (in_array($imageExtension, $extensions)) {
                    
                    $amountOfArtworks = Artwork::all()->count();
                    
                    $artwork = new Artwork();
                    $artwork->title = $input['name'];
                    $artwork->description = $input['description'];
                    $artwork->user_id = Auth::user()->id;
                    $artwork->extension = $imageExtension;
                    $artwork->save();
                    
                    $filename = ($artwork->id . '.' . $imageExtension);
                    
                    $image->move('images/artworks', $filename);
                    
                    return redirect()->to('/gallery')->with('message', 'Foto verstuurd!');
                    
                } else {
                    return redirect()->to('/gallery/create')->withErrors(array('Bestand moet een foto zijn.'));
                }
                
            }
            
		} else {
			return redirect()->to('/')->withErrors('Als gebruiker mag je niets insturen.');
		}
    }
    
    public function json() {
        if (Auth::check() && Auth::user()->isModerator()) {
            $artworks = Artwork::all();
            return $artworks;
        } else {
            $artworks = Artwork::where('state', 1)->get();
            return $artworks;
        }
    }

}
