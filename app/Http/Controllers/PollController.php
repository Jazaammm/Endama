<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\PollOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PollController extends Controller
{
    public function createpollform()
    {
        return view('auth.professor.polldropdown.createnewpoll');
    }

    public function storepoll(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string|max:255',
            'status' => 'required|in:planned,ongoing,complete',
        ]);

        // Create the poll
        $poll = Poll::create([
            'professor_id' => Auth::guard('professor')->id(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'status' => $validated['status'],
        ]);

        // Create poll options
        foreach ($validated['options'] as $option) {
            PollOption::create([
                'poll_id' => $poll->id,
                'title' => $option,
            ]);
        }

        return redirect()->route('plannedpoll')->with('success', 'Poll created successfully!');
    }

    public function showpoll($id)
{
    $poll = Poll::with('options')->findOrFail($id);

    return response()->json([
        'title' => $poll->title,
        'description' => $poll->description,
        'start_date' => $poll->start_date,
        'end_date' => $poll->end_date,
        'status' => $poll->status,
        'options' => $poll->options,
    ]);
}



public function editpoll($id, Request $request)
{
    $poll = Poll::with('options')->findOrFail($id);

    $returnRoute = $request->input('return', 'plannedpoll');

    return view('auth.professor.polldropdown.editpoll', compact('poll', 'returnRoute'));
}


public function updatepoll(Request $request, $id)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'options' => 'required|array|min:2',
        'options.*' => 'required|string|max:255',
        'status' => 'required|in:planned,ongoing,complete',
    ]);

    $poll = Poll::findOrFail($id);

    if ($poll->professor_id !== Auth::guard('professor')->id()) {
        return redirect()->route('plannedpoll')->with('error', 'You are not authorized to edit this poll.');
    }

    $poll->update([
        'title' => $validated['title'],
        'description' => $validated['description'],
        'start_date' => $validated['start_date'],
        'end_date' => $validated['end_date'],
        'status' => $validated['status'],
    ]);

    $poll->options()->delete();

    foreach ($validated['options'] as $option) {
        PollOption::create([
            'poll_id' => $poll->id,
            'title' => $option,
        ]);
    }

    // Redirect based on status
    if ($validated['status'] === 'ongoing') {
        return redirect()->route('poll.ongoing')->with('success', 'Poll updated and moved to Ongoing.');
    }
    elseif ($validated['status'] === 'complete') {
       return redirect()->route('poll.completed')->with('success', 'Poll marked as Complete.');
    }
    else {
        return redirect()->route('plannedpoll')->with('success', 'Poll updated successfully!');
    }
}




}
