<?php

namespace App\Http\Controllers;

use App\Http\Requests\CrewRequest;
use App\Models\Crew;
use App\Models\Document;
use Illuminate\Http\Request;
use Validator;

class CrewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $crews = Crew::orderBy('created_at', 'desc')->get();
        return response()->json($crews, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crew.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrewRequest $request)
    {
        $data = [
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'address' => $request->address,
            'education' => $request->education,
            'contact' => $request->contact
        ];

        Crew::create($data);

        return response()->json(['message' => 'Crew details has been successfully saved!', 'status' => 200]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $crew = Crew::where('id', $id)->get();

        if (count($crew) > 0) {
            return response()->json(['status' => 200, 'crew' => $crew], 200);
        }

        return response()->json(['message' => 'crew detail not found!'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $crew = Crew::where('id', $id)->get();

        if (count($crew) > 0) {

            return view('crew.edit', compact('crew'));
        }
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CrewRequest $request, $id)
    {

        $data = [
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'address' => $request->address,
            'education' => $request->education,
            'contact' => $request->contact
        ];

        Crew::where('id', $id)
            ->update($data);

        return response()->json(['message' => 'Crew details has been updated', 'status' => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Crew::where('id', $id)->delete();
        Document::where('crew_id', $id)->delete();
        return response()->json(['message' => 'Crew details has been deleted', 'status' => 200]);
    }
}
