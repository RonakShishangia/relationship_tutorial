<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Phone;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $contacts = Contact::with('phone')
                        ->orderBy('id', 'desc')
                        ->get();
            return view('pages.relationship.one_to_one.index', compact('contacts') );
        } catch (\Exception $e) {
            dd($e);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            return view('pages.relationship.one_to_one.create');
        } catch (\Exception $e) {
            dd($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required',
            'email'=>'required',
            'number'=>'required',
        ]);
        try {
            $contact = new Contact();
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->save();

            $phone = new Phone();
            $phone->contact_id = $contact->id;
            $phone->number = $request->number;
            $phone->save();
            return redirect()->route('onetoone.index');
        } catch (\Exception $e) {
            dd($e);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $contact = Contact::with('phone')->whereId($id)->first();
            return view('pages.relationship.one_to_one.edit', compact('contact') );
        } catch (\Exception $e) {
            dd($e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'=>'required',
            'email'=>'required',
            'number'=>'required',
        ]);
        try {
            $contact = Contact::find($id);
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->save();

            $phone = Phone::find($contact->id);
            $phone->number = $request->number;
            $phone->save();
            return redirect()->route('onetoone.index');
        }
        catch(\Exception $e){
            dd($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Contact::destroy($id);
            return redirect()->route('oentotone.index');
        } catch (\Exception $e) {
            dd($e);
        }

    }
}
