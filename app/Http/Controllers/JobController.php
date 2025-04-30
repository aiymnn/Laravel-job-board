<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $jobs = Job::query();
        // $jobs->when(request('search'), function ($query) {
        //     $query->where(function ($query) {
        //         $query->where('title', 'like', '%' . request('search') . '%')
        //             ->orWhere('description', 'like', '%' . request('search') . '%');
        //     });
        // })->when(request('min_salary'), function ($query){
        //     $query->where('salary', '>=', request('min_salary'));
        // })->when(request('max_salary'), function ($query){
        //     $query->where('salary', '<=', request('max_salary'));
        // })->when(request('experience'), function ($query){
        //     $query->where('experience', '=', request('experience'));
        // })->when(request('category'), function ($query) {
        //     $query->where('category', '=', request('category'));
        // })->latest();

        //  return view('jobs.index', ['jobs' => $jobs->get()]);

        $this->authorize('viewAny', Job::class);

        $filters = request()->only(
            'search',
            'min_salary',
            'max_salary',
            'experience',
            'category'
        );

        $jobs = Job::with('employer')->filter($filters)->latest()->get();

        return view('jobs.index', ['jobs' => $jobs]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        $this->authorize('view', $job);
        $job->load('employer.jobs');
        return view('jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
