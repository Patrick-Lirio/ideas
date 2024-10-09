<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $ideas = Idea::orderBy('created_at','DESC');

        //check if there is a search
        if(request()->has('search')){
            $ideas = $ideas->where('content','like','%'.request()->get('search','').'%');
        }
        // Uncomment the following line if you want to dump all ideas (for debugging)
        // dump(Idea::all());

        // Return the 'dashboard' view with ideas ordered by 'created_at' in descending order
        return view('dashboard', [
            'ideas' => $ideas->paginate(5)
            // 'ideas' => Idea::orderBy('created_at', 'DESC')->paginate(5)
        ]);
    }
}
