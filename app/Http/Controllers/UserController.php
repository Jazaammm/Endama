<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function AdminDashboard(){
        $totalProfessors = Professor::count();
        $totalStudents = Student::count();
        return view('auth.admin.dashboard', compact('totalProfessors', 'totalStudents'));
    }

    public function professorlist(Request $request){
        $search = $request->input('search');
        $entries = $request->input('entries', 10);

        $professors = Professor::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
        })->paginate($entries);

        return view('auth.admin.proflist', compact('professors'));
    }

    public function AddProfForm(){
        return view('auth.admin.addnewprof');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:professors',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $professor = Professor::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('proflist')->with('success', 'Add New Professor is successful.');
    }

    public function edit($id)
{
    $professor = Professor::findOrFail($id);
    return view('auth.admin.editprof', compact('professor'));
}
public function update(Request $request, $id)
{
    $professor = Professor::findOrFail($id);

    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:professors,email,'.$id,
        'password' => 'nullable|string|min:6|confirmed',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $professor->update([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password ? Hash::make($request->password) : $professor->password,
    ]);

    return redirect()->back()->with('success', 'Professor updated successfully.');
    }

    public function delete($id)
    {
        $professor = Professor::findOrFail($id);

        $professor->delete();

        return redirect()->route('proflist')->with('success', 'Professor deleted successfully.');
    }

    public function studentlist(Request $request)
{
    $query = Student::query();
    if ($request->has('search')) {
        $query->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('email', 'like', '%' . $request->search . '%');
    }
    $entries = $request->input('entries', 10);
    $students = $query->paginate($entries);

    return view('auth.admin.studentlist', compact('students'));
}

public function editstudent($id)
{
    $student = Student::findOrFail($id);
    return view('auth.admin.editstudent', compact('student'));
}
public function updatestudent(Request $request, $id)
{
    $student = Student::findOrFail($id);

    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:professors,email,'.$id,
        'password' => 'nullable|string|min:6|confirmed',
        'year_level' => 'required|string',
        'section' => 'required|string|max:10',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $student->update([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password ? Hash::make($request->password) : $student->password,
        'year_level' => $request->year_level,
        'section' => $request->section,
    ]);

    return redirect()->back()->with('success', 'Student updated successfully.');
    }



public function AdminProfile(){
    return view ('auth.admin.accprofile');
}

public function updatePhoto(Request $request)
{
    $request->validate([
        'photo' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('profile_photos'), $filename);

        $user = Auth::user();
        $user->photo = $filename;
        $user->save();
    }

    return redirect()->back()->with('success', 'Photo updated successfully!');
}

public function adminchangepasswordform()
{
    return view('auth.admin.accsettings');
}

public function adminchangepassword(Request $request)
{
    $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users,email,' . Auth::id(),
        'password' => 'nullable|string|min:6|confirmed',
    ]);

    $user = Auth::user();
    $user->name  = $request->name;
    $user->email = $request->email;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return back()->with('success', 'Account updated successfully.');
}


}
