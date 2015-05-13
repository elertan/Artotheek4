<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use Input;
use Validator;
use App\News;

class NewsController extends Controller {
    
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        if (Auth::check() && Auth::user()->isModerator()) {
            return view('news/create');
        } else {
            return redirect()->to('/');
        }
	}
    
    public function createSubmit() {
        if (Auth::check() && Auth::user()->isModerator()) {
            $input = Input::all();
            
            $validator = Validator::make(
                $input,
                array(
                    'title' => 'required|min:5',
                    'body' => 'required|min:20'
                )
            );
            
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors());
            } else {
                $this->store($input['title'], $input['body']);
                return redirect()->to('/')->with('message', 'Artikel geplaatst.');
            }
            
        } else {
            return redirect()->back()->withErrors(array('Artikel plaatsen geweigerd.'));
        }
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($title, $body)
	{
		$article = new News();
        $article->title = $title;
        $article->body = $body;
        $article->state = 1;
        $article->user_id = Auth::user()->id;
        
        $article->save();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$article = News::find($id);
        if (!$article) {
            return redirect()->to('/')->withErrors(array('Nieuws artikel bestaat niet.'));
        } else {
            return view('news/show', array(
                'article' => $article
            ));
        }
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        if (Auth::check() && Auth::user()->isModerator()) {
            $article = News::find($id);
            if (!$article) {
                return redirect()->to('/')->withErrors(array('Nieuws artikel bestaat niet'));
            } else {
                return view('news/edit', array(
                    'article' => $article
                ));
            }
        } else {
            return redirect()->to('/')->withErrors(array('Je hebt geen toestemming om dit artikel te wijzigen.'));
        }
	}
    
    public function editSubmit($id) {
        if (Auth::check() && Auth::user()->isModerator()) {
            
            $input = Input::all();
            
            $validator = Validator::make(
                $input,
                array(
                    'title' => 'required|min:5',
                    'body' => 'required|min:20'
                )
            );
            
            $article = News::find($id);
            if (!$article) {
                return redirect()->to('/')->withErrors(array('Nieuws artikel bestaat niet'));
            } else {
                // Validation
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator->errors());
                } else {
                    $article->title = $input['title'];
                    $article->body = $input['body'];
                    
                    $article->save();
                    
                    return redirect()->to('/')->with('message', 'Artikel gewijzigd.');
                }
                
            }
        } else {
            return redirect()->to('/')->withErrors(array('Je hebt geen toestemming om dit artikel te wijzigen.'));
        }
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        if (Auth::check() && Auth::user()->isModerator()) {
            $article = News::find($id);
            if ($article) {
                $article->delete();
                return redirect()->to('/')->with('message', 'Artikel verwijderd.');
            } else {
                return redirect()->to('/')->withErrors(array('Het artikel dat je probeerde te verwijderen was niet gevonden.'));
            }
        } else {
            return redirect()->to('/')->withErrors(array('Je hebt geen toestemming dit artikel te verwijderen'));
        }
	}
    
    public function json() {
        $news = [];
        if (Auth::check() && Auth::user()->isModerator()) {
            $news = News::orderBy('updated_at', 'DESC')->get();
            $count = 0;
            foreach ($news as $article) {
                $news[$count]['stateString'] = ((int)$article['state'] ? 'Gepubliceerd' : 'Gearchiveerd');
                $count++;
            }
        } else {
            $news = News::where('state', 1)->orderBy('updated_at', 'DESC')->get();
        }
        
        return $news;
    }
    
    public function archive($id) {
        if (Auth::check() && Auth::user()->isModerator()) {
            
            $news = News::find($id);
            if (!$news) {
                return redirect()->to('/')->withErrors(array('Het artikel dat je probeerde te archiveren was niet gevonden.'));
            } else {
                $news->state = 0;
                $news->save();
                
                return redirect()->to('/')->with('message', 'Artikel gearchiveerd.');
            }
            
        } else {
            return redirect()->to('/')->withErrors(array('Je hebt geen toestemming dit artikel te archiveren.'));
        }
    }

}
