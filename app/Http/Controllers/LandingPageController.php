<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Hero;

class LandingPageController extends Controller
{
    //
    public function index()
    {
        //get one hero that is active
        $hero = \App\Models\Hero::where('is_active', true)->first();
        [$mainTitle, $animationTitle] = explode('#', $hero->title);
        $animationTitle = explode('|', $animationTitle);

        //get all services
        $services = Service::all();

        //get all services order by ascending
        //  $services = \App\Models\Service::orderBy('position')->get();
        //get 10 portfolio order by descending
        // $portfolios = \App\Models\Portfolio::latest()->take(10)->get();
        //get all clients order by random
        //  $clients = \App\Models\Client::inRandomOrder()->get();
        //get all team
        // $teams = \App\Models\Team::all();

        return view('welcome', compact('hero', 'mainTitle', 'animationTitle', 'services'));
    }
}
