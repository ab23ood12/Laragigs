<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('lisitings.index',[
            'listings' => Listing::paginate(6)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lisitings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formfields = $request->validate([
            'title' => 'required',
            'company' => ['required',Rule::unique('listings','company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required','email'],
            'tags'=> 'required',
            'description' => 'required'
        ]);

        $formfields['user_id'] = auth()->id();

        Listing::create($formfields);

        // return redirect('/')->with('message','Listing created successfully!');

        return response('formfiels',$status='200');
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {

        return view('lisitings.show',[
            'listing'=> $listing
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        return view('lisitings.edit',['listing' => $listing]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        $formfields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required','email'],
            'tags'=> 'required',
            'description' => 'required',
        ]);

        $listing->update($formfields);

        return back()->with('message','Listing created successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        $listing->delete();
        return redirect('/');
    }

    public function manage(){
        return view('manage',['listings'=>auth()->user()]);
        // ->user()->get()]);
    }
}
