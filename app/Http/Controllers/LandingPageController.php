<?php

namespace App\Http\Controllers;

use App\Model\Bulletin;
use App\Model\User;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function home(User $user, Bulletin $bulletin)
    {
        $bulletins = $bulletin->getLatest()->all();
        $users = $user->getTopUsers()->all();
        $slides = $user->getSlides()->all();

        return view('landing')
            ->with('bulletins', $bulletins)
            ->with('users', $users)
            ->with('slides', $slides);
    }
}
