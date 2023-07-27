<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentRequest;
use App\Models\Crew;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function create($crew_id)
    {
        $crew = Crew::where('id', $crew_id)->get();

        if (count($crew) > 0) {

            $documents = Document::with(['crew'])->orderBy('created_at', 'desc')->where('crew_id', $crew_id)->simplePaginate(10);

            return view('document.create', compact('crew', 'documents'));
        }
        return abort(404);
    }

    public function  store($crew_id, DocumentRequest $request)
    {
        $data = [
            'crew_id' => $crew_id,
            'code' => $request->code,
            'name' => $request->name,
            'document_number' => $request->document_number,
            'issued' => $request->issued,
            'expiry' => $request->expiry,
            'remarks' => $request->remarks,

        ];

        Document::create($data);

        return response()->json(['message' => 'Document for crew id - [' . $crew_id . '] created', 'status' => 200]);
    }

    public function edit($document_id)
    {
        $doc = Document::where('id', $document_id)->get();

        if (count($doc) > 0) {
            return view('document.edit', compact('doc'));
        }

        return abort(404);
    }

    public function update($document_id, DocumentRequest $request)
    {
        $data = [
            'code' => $request->code,
            'name' => $request->name,
            'document_number' => $request->document_number,
            'issued' => $request->issued,
            'expiry' => $request->expiry,
            'remarks' => $request->remarks,

        ];

        Document::where('id', $document_id)->update($data);

        return response()->json(['message' => 'Document has been updated', 'status' => 200]);
    }

    public function show($id)
    {
        $document = Document::where('id', $id)->get();

        if (count($document) > 0) {
            return response()->json(['status' => 200, 'document' => $document], 200);
        }

        return response()->json(['message' => 'document detail not found!'], 404);
    }

    public function destroy($id)
    {
        Document::where('id', $id)->delete();
        return response()->json(['message' => 'Document details has been deleted', 'status' => 200]);
    }

    public function getAll()
    {
        $documents = Document::orderBy('created_at', 'desc')->get();
        return response()->json($documents, 200);
    }
}
