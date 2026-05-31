<?php

namespace App\Http\Controllers;

use App\Models\Student;
use BaconQrCode\Encoder\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use SimpleSoftwareIO\QrCode\Facades\QrCode as FacadesQrCode;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all()->map(function ($student){
            $student->qr=FacadesQrCode::size(100)->generate(route('students.view', $student->id));
            return $student;
        });

        return view('index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function addcreate()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addstudent(Request $request)
    {
        $validated = $request->validate([
            'lname' => 'required|min:3',
            'fname' => 'required|min:3',
            'mname' => 'required|min:3',
            'course' => 'required|min:2',
            'yearlevel' => 'required|numeric|max:10',
            'pic' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        $image = $request->file('pic');
        $name = time().'_'.$image->getClientOriginalName();
        $image->move(public_path('images'), $name);
        
        Student::create([
            'lname' =>$request->lname,
            'fname' => $request->fname,
            'mname' => $request->mname,
            'course' => $request->course,
            'yearlevel' => $request->yearlevel,
            'pic' => $name
        ]);

        return redirect()->route('students.index')->with('success', 'Student has been Added');
    }

    /**
     * Display the specified resource.
     */
    public function show($id,)
    {
        $student = Student::findOrFail($id);
        $qr = FacadesQrCode::size(200)->generate(json_encode([
            'id' => $student->id,
            'lname' => $student->lname,
            'course' => $student->course,
            'yearlevel' => $student->yearlevel 
        ]));

        return view('view', compact('student','qr'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);

        return view('edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatestudent(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $validated = $request->validate([
            'lname' => 'required|min:3',
            'fname' => 'required|min:3',
            'mname' => 'required|min:3',
            'course' => 'required|min:2',
            'yearlevel' => 'required|numeric|max:10',
            'pic' => 'image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        $student->lname = $request->lname;
        $student->fname = $request->fname;
        $student->mname = $request->mname;
        $student->course = $request->course;
        $student->yearlevel = $request->yearlevel;

        if($request->hasFile('pic')){
            $oldimage = public_path('images/'.$student->pic);

            if(File::exists($oldimage)){
                File::delete($oldimage);
            }

            $newimage = $request->File('pic');
            $name = time().'_'.$newimage->getClientOriginalName();
            $newimage->move(public_path('images'), $name);

            $student->pic = $newimage;

        }

        $student->save();

        return redirect()->route('students.index')->with('success', 'Student Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $student = Student::findOrFail($id);

        $image_path = public_path('images/' . $student->pic);

        if(File::exists($image_path)){
            File::delete($image_path);
        }

        $student->delete();
        
        return back()->with('success', 'Student Successfully Deleted');
    }
}
