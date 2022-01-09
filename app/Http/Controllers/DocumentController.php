<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentRequest;
use App\Http\Requests\DocUpdate;
use App\Models\Document;
use App\Models\Requirement;
use Illuminate\Http\Request;
use App\Models\User;
use Session;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\DocumentStudentRequest;
class DocumentController extends Controller
{
    public $d_id;

    public function index(){
        $requirements = Requirement::get();
        $documents = Document::get();
        return view('admin-add-documents', compact('requirements', 'documents'));
    }

    public function rule(){
        return [
            'price' => 'required|numeric',
        ];
    }
    public function store(DocumentRequest $request){

        $validated = $request->validated([
            'doc_name' => 'required',
            'price' => 'required|numeric'
        ]);
    
        $document = Document::create([
            'document_name' => $validated['doc_name'],
            'price' => $validated['doc_price']
        ]);
        foreach ($validated['requirements'] as $key => $value)
        {
            $document->requirements()->attach($value);
        }
        Alert::success('Success', 'Sucessfully added a Document');
        return redirect()->route('document.create');
    }
    public function list(){

        $documents = Document::get();
        return view('admin-list-documents', compact('documents'));
    }

    public function attach(DocumentStudentRequest $request){
  
        $validated = $request->validated();
        if($validated['documents'] !=null){
            $user = User::find(auth()->user()->id);
       
            foreach($validated['documents'] as $key => $value){
                $user->documents()->attach($value);
            }
        Alert::success('Success', 'Successfully Sent Request');
        return redirect()->route('student.profile')->with('message', 'You have successfully requested a Document');

        }
        else{
        return redirect()->route('student.profile')->with('error-message', 'Please Select atleast one Document');
        }
        
    }
    public function destroy(Request $request)
    {
        $user = Document::findorfail($request->id);

        $user->delete();
        Alert::error('Deleted', 'Deleted Successfully');
      
        return redirect()->back()->with('message', 'Deleted Successfully');
    }

    public function editDocument($id)
    {
        $this->d_id = $id;

        $documents = Document::find($id);
        $requirements = Requirement::get();
        return view('admin-edit-document',compact('documents', 'requirements'))
        ->with('documents', Document::where('id', $id)->first());
    }

    public function update(DocUpdate $req, $id){

        $document = Document::find($id);
        $validated = $req->validated();

        $document->update([
            'document_name' => $validated['doc_name'],
            'price' => $validated['doc_price']
        ]);
        
        Alert::success('Success', 'Sucessfully Updated a Document');
        return redirect()->back();
    }

    public function detached($id, $doc){
 
        $requirement = Requirement::find($id);
        $document = Document::find($doc);
  
        $document->requirements()->detach($id);
        Alert::success('Success', 'Sucessfully Deleted a requirement');
        return redirect()->back();
    }

}