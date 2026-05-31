<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentsController extends Controller
{

    public function loginView(){
        return view('students.login');
    }

    public function loginCreate(){
        return view('students.login');
    }

    public function logins(Request $request){
        $validated = $request->validate([
            'username' => 'required|min:3|max:20|exists:students,username',
            'password' => 'required|min:6',
        ]);

        if(Auth::attempt([
            'username' => $request->username,
            'password' => $request->password,
        ])){
            $request->session()->regenerate();
            // $student = Auth::students();

            return redirect()->route('students.homepageView');
        }

        return back()->withErrors([
            'password' => 'Incorrect Password'
        ])->withInput();
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function homepageView(){
        return view('students.homepage');
    }

    public function registerView(){
        return view('students.register');
    }

    public function registerCreate(){
        return view('students.register');
    }

    public function registerStore(Request $request){
        $validated = $request->validate([
            'lname' => 'required|alpha|min:3|max:20',
            'fname' => 'required|alpha|min:3|max:20',
            'Mname' => 'nullable|alpha|max:5',
            'username' => 'required|min:3|max:20',
            'email' => 'required|email|unique:students,email',
            'age' => 'required|integer|min:18',
            'dob' => [
                'required',
                'date',
                'before:'. Carbon::now()->subYears(18)->format('Y-m-d'),
                'after:'. Carbon::now()->subYears(30)->format('Y-m-d')],
            'gender' => 'required|in:Male,Female',
            'password' => 'required|min:6|confirmed'
        ],
        [
            'password.confirmed' => 'Passwords do not match',
        ]);

        DB::table('students')->insert([
            'lname' => $request->lname,
            'fname' => $request->fname,
            'Mname' => $request->Mname,
            'username' => $request->username,
            'email' => $request->email,
            'age' => $request->age,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Student Registration Successful!');
    }

    public function studentsEdit($id){
        $students = DB::table('students')->where('id', $id)->first();

        if(!$students){
            return redirect()->route('students.homepageView')->with('error', 'Student not Found');
        }

        return view('students.edit', compact('students'));
    }

    public function studentsUpdate(Request $request, $id){
        DB::table('students')->where('id', $id)->update([
            'lname' => $request->lname,
            'fname' => $request->fname,
            'Mname' => $request->Mname,
            'username' => $request->username,
            'email' => $request->email,
            'age' => $request->age,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
            'updated_at' => now(),
        ]);

        return redirect()->route('students.homepageView');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Students $students)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Students $students)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Students $students)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Students $students)
    {
        //
    }
}
