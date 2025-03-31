<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Google_Client;
use Google_Service_Sheets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;


class StudentController extends Controller
{
    public function registrationform()
    {
        return view('auth.student.register');
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students',
            'password' => 'required|string|min:6|confirmed',
            'year_level' => 'required|string',
            'section' => 'required|string|max:10',
        ]);

        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'year_level' => $request->year_level,
            'section' => $request->section,
        ]);

        return redirect()->back()->with('success', 'Registration successful.');

    }

    public function verify(){
        return view('auth.student.verify');
    }




    public function verification(Request $request)
   {


        $validated = $request->validate([
            'student_number' => 'required'
        ]);

        $studentNumber = $validated['student_number'];

        $credentialsPath = storage_path('app/google/credentials.json');
        putenv("GOOGLE_APPLICATION_CREDENTIALS=$credentialsPath");


        $client = new Google_Client();
        $client->setAuthConfig($credentialsPath);
        $client->addScope('https://www.googleapis.com/auth/spreadsheets.readonly');


        $service = new Google_Service_Sheets($client);



        $spreadsheetId = '1fz4qZo_BhhTPqftB36MpbkolkkhN0Du0-RBtGHcUcIg';
        $range = 'CIT!A1:F99';

        try {

            $response = $service->spreadsheets_values->get($spreadsheetId, $range);
            $values = $response->getValues();



            if (empty($values)) {
                return response()->json(['message' => 'No data found.']);
            }


            $found = false;
            foreach ($values as $row) {
                if ($row[0] == $studentNumber) {
                    $found = true;
                    // $fullName = trim($row[3] . ' ' . $row[4] . ' ' . $row[2]);
                     $fullName = $row[1] ?? null;
                    $gmail = $row[2] ?? null;
                    $year_level = $row[3] ?? null;
                    $section = $row[4] ?? null;
                    break;
                }
            }


            if (!$found) {
                return redirect()->back()->with('error', 'Student Number Not Found');
            }

            return redirect()->route('register', compact('fullName', 'gmail', 'year_level', 'section'));

        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch data from Google Sheets: ' . $e->getMessage()]);
        }
    }




   public function useGoogleClient()
    {
        $credentialsPath = storage_path('app/google/credentials.json');
        putenv("GOOGLE_APPLICATION_CREDENTIALS=$credentialsPath");


        $client = new Google_Client();
        $client->setAuthConfig($credentialsPath);
        $client->addScope('https://www.googleapis.com/auth/spreadsheets.readonly');


        $service = new Google_Service_Sheets($client);


        $spreadsheetId = '1fz4qZo_BhhTPqftB36MpbkolkkhN0Du0-RBtGHcUcIg';
        $range = 'CIT!A1:F99';

        try {

            $response = $service->spreadsheets_values->get($spreadsheetId, $range);


            $values = $response->getValues();

            if (empty($values)) {
                return response()->json(['message' => 'No data found.']);
            } else {
                return view('Student_list', ['data' => $values]);
            }

        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch data from Google Sheets: ' . $e->getMessage()]);
        }
    }

    public function showlogin(){
        return view('auth.login');
    }

    public function StudentDashboard(){
        return view ('auth.student.dashboard');
    }

}
