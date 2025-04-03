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

        // dd($validator->errors(), $validator->fails());

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
        $professor = Professor::findOrFail($id); // Find the professor by ID

        $professor->delete(); // Delete the professor

        return redirect()->route('proflist')->with('success', 'Professor deleted successfully.');
    }

    public function studentlist(Request $request)
{
    $query = Student::query();

    // Search functionality
    if ($request->has('search')) {
        $query->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('email', 'like', '%' . $request->search . '%');
    }

    // Pagination functionality
    $entries = $request->input('entries', 10);
    $students = $query->paginate($entries);

    return view('auth.admin.studentlist', compact('students'));
}


}
