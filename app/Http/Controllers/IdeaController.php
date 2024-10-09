<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class ideaController extends Controller
{
    public function show(Idea $idea)
    {
        // dd($idea->comments);
        return view('ideas.show',compact('idea'));
    }

    public function store()
    {
        request()->validate([
            'content' => 'required|min:3|max:240'
        ]);


        // dump($_POST);
        // dump(request());
        //dump(request()->get('idea',null));

        // Create a new instance of the Idea model with 'content'
        $idea = Idea::create([
            'content' => request()->get('content', null),
        ]);
        // $idea->save(); // Save the instance to the database
        return redirect()->route('dashboard')->with('success','Idea Created Successfully!');
    }

    public function destroy(Idea $idea){
        // $idea = Idea::where("id",$id)->firstOrFail()->delete();


        $idea->delete();

        return redirect()->route('dashboard')->with('success','Idea Deleted Successfully!');
    }

    public function edit(Idea $idea)
    {
        $editing = true;
        return view('ideas.show',compact('idea','editing'));
    }

    public function update(Idea $idea)
    {
        request()->validate([
            'content' => 'required|min:3|max:240'
        ]);
       $idea->content = request()->get('content','');
       $idea->save();

       return redirect()->route('ideas.show', $idea->id)->with('success','Idea updated successfully!');
    }
}
