<?php

namespace App\Http\Controllers;

use App\Models\Job;

use Illuminate\Http\Request;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class JobApplicationController extends Controller
{
    use AuthorizesRequests;
    /**
     * Show the form for creating a new resource.
     */
    public function create(Job $job)
    {
        $this->authorize('apply', $job);
        return view('job_application.create', ['job' => $job]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Job $job, Request $request)
    {
        $this->authorize('apply', $job);

        $validatedData = $request->validate([
            'expected_salary' => 'required|min:1|max:1000000',
            'cv' => 'required|file|mimes:pdf|max:2048',
        ]);

        $file = $request->file('cv');

        // // Buat nama fail yang selamat
        // $filename = uniqid() . '_' . preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $file->getClientOriginalName());
        // $path = 'cvs/' . $filename;

        // // Simpan fail ke disk 'local' (sama macam asal)
        // $stream = fopen($file->getPathname(), 'r');
        // Storage::disk('local')->put($path, $stream);
        // fclose($stream);

        // // Simpan ke dalam database (macam asal)
        // $job->jobApplications()->create([
        //     'user_id' => $request->user()->id,
        //     'expected_salary' => $validatedData['expected_salary'],
        //     'cv_path' => $path,
        // ]);

        // return redirect()->route('jobs.show', $job)
        //     ->with('success', 'Job application submitted.');

        // Nama fail selamat
        $filename = uniqid() . '_' . preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $file->getClientOriginalName());
        $path = 'cvs/' . $filename;

        // Simpan fail ke storage/app/private/cvs
        $stream = fopen($file->getPathname(), 'r');
        Storage::disk('private')->put($path, $stream);
        fclose($stream);

        // Simpan dalam database
        $job->jobApplications()->create([
            'user_id' => $request->user()->id,
            'expected_salary' => $validatedData['expected_salary'],
            'cv_path' => $path, // contoh: cvs/unique_nama.pdf
        ]);

        return redirect()->route('jobs.show', $job)
            ->with('success', 'Job application submitted.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function downloadCV(JobApplication $application)
    {
        if (Storage::disk('private')->exists($application->cv_path)) {
            return Storage::disk('private')->download($application->cv_path);
        }

        return redirect()->back()->with('error', 'CV file not found.');
    }
}
