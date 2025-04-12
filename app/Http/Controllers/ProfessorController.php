<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfessorController extends Controller
{
    public function ProfessorDashboard(){
        $totalStudents = Student::count();
        return view('auth.professor.dashboard', compact('totalStudents') );
    }


    public function ProfessorProfile(){
        return view("auth.professor.profprofile");

    }

    public function ProfupdatePhoto(Request $request)
{
    $request->validate([
        'photo' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('prof_photos'), $filename);

        $user = Auth::guard('professor')->user();
        $user->photo = $filename;
        $user->save();
    }

    return redirect()->back()->with('success', 'Photo updated successfully!');
}

     public function profchangepassform(){
        return view('auth.professor.profsettings');
     }

        public function profchangepass(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . Auth::guard('professor')->id(),
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user = Auth::guard('professor')->user();
        $user->name  = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Change Password Successfully.');
    }



    public function viewstudentlist(Request $request)
    {
        $query = Student::query();
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        }
        $entries = $request->input('entries', 10);
        $students = $query->paginate($entries);

        return view('auth.professor.viewstudentlist', compact('students'));
    }


    public function plannedpoll(Request $request)
    {
        $query = Poll::where('status', 'planned'); // Only get polls with status 'planned'

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $entries = $request->input('entries', 10);
        $polls = $query->paginate($entries);

        return view('auth.professor.polldropdown.plannedpoll', compact('polls'));
    }



        public function ongoingpoll(Request $request)
    {
        $query = Poll::where('status', 'ongoing'); // Only get polls with status 'ongoing'

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        // Pagination entries per page, defaulting to 10
        $entries = $request->input('entries', 10);
        $polls = $query->paginate($entries);

        return view('auth.professor.polldropdown.ongoingpoll', compact('polls'));
    }

    public function completedpoll(Request $request)
    {
        $query = Poll::where('status', 'complete'); // Only get polls with status 'ongoing'

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        // Pagination entries per page, defaulting to 10
        $entries = $request->input('entries', 10);
        $polls = $query->paginate($entries);

        return view('auth.professor.polldropdown.completedpoll', compact('polls'));
    }










}
