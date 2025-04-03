<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    public function ProfessorDashboard(){
        return view("auth.professor.dashboard");
    }
}
