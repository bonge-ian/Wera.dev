<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Job;
use App\Apply;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use App\Notifications\Applicants;
use PDF;

class ApplyController extends Controller
{
    /**
     * Show the application form
     *
     *@param App\Job $job to apply
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Job $job)
    {
        if (Auth::id() == $job->user->id) {
            return redirect('/jobs')->with('error', 'You cant apply form your own job listing');
        }
        return view('wera.apply')->with('job', $job);
    }

    /**
     * Store The user's application submission
     *
     * @param App\Job $job - job to apply
     * @return \Illuminate\Http\Response
     */
    public function store(Job $job)
    {
        $validated = request()->validate([
            'firstname' => 'required|min:3',
            'lastname' => 'required|min:3',
            'email' => 'required|email|max:191',
            'experience' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value == 'Experience level' || $value == '') {
                        $fail('Please, state your experience level.');
                    }
                }
            ],
            'availability' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value == 'Availability' || $value == '') {
                        $fail('Please, state your availability if you are the successfull candidate.');
                    }
                }
            ],
            'message' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (str_word_count($value, 0) > 400) {
                        $fail('Your cover letter should not exceed 400 words.');
                    }
                }
            ],
            'resume' => 'required|mimes:doc,pdf,docx,zip|file|max:2048'
        ]);

        // get the name of file uploaded
        $filename = request()->resume->getClientOriginalName();

        // get the extension of the file uploaded.
        $fileExt = request()->resume->getClientOriginalExtension();

        // name which the file will be stored in db
        $fileStored = $filename . '_' . time() . '.' . $fileExt;

        // store the file in our application in uploads folder
        request()->resume->storeAs('public/uploads', $fileStored);

        // update the value of resume key in validated array
        $validated['resume'] = $fileStored;

        // append the following to validated
        $validated = Arr::add($validated, 'job_id', $job->id);
        $validated = Arr::add($validated, 'user_id', Auth::id());
    
        // insert to DB
        Apply::create($validated);

        // owner of the job
        $employee = $job->user;

        // send notification
        $employee->notify(new Applicants($validated));
        
        // return redirect
        return redirect()
            ->route('jobs.index')
            ->with('success', 'You have successfully applied for this job');
    }

    public function viewApplication($application)
    {
        $application = Auth::user()->notifications->where('id', $application)->pluck('data.application')->first();
       // dd($application);
        
        $pdf = PDF::loadView('wera.application', ['application' => $application]);
        return $pdf->download('application.pdf');
    }

    public function download($job, $name)
    {
        $app = Apply::where('job_id', $job)->where('firstname', $name)->first();
        
        $resume = $app->resume;

        $ext = pathinfo($resume, PATHINFO_EXTENSION);

        $file =  public_path() .  '/storage/uploads/' .$resume;

        $header = ['Content-Type: application/pdf'];

        $filename = $app->firstname . ' ' . $app->lastname . $ext;
         return Response::download($file, $filename);
    }
}
