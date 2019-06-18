<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

class JobsController extends Controller
{
    /**
     * Show all jobs
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('wera.index', [
            'jobs' => Job::latest()->paginate(6),
            'categories' => $this->getCategories()
        ]);
    }

    /**
     * Browse jobs depending on category
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function jobByCategory(Request $request)
    {
        $cat_id = $request->cat;

        // get the jobs in the category
        $jobs = Job::where('category_id', $cat_id)->paginate(6);
        
        // return view
        return view('wera.jobcat')->with([
            'jobs' => $jobs,
            'categories' => $this->getCategories(),
            'cat' => $cat_id, // to append to pagination links().
        ]);
    }

    /**
     * Show job details
     *
     * @param App/Job $job
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        return view('wera.view-job')->with('job', $job);
    }

    /**
     * Show create job listing view
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('wera.create')->with('categories', $this->getCategories());
    }

    /**
     * Store new job details
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the form inputs
        $validated = $request->validate([
            'title' => 'required|min: 3|max: 191',
            'company' => 'required|min: 3|max: 191',
            'cat' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value == 0) {
                        $fail('You must choose a category');
                    }
                }
            ],
            'summary' => 'required',
            'description' => 'required',
            'contact_name' => 'required|min: 3|max: 191',
            'contact_email' => 'required|email|max: 191'
        ]);

        // append cateogry_id key and give it value of $val['cat']
        $validated = Arr::add($validated, 'category_id', $validated['cat']);

        // append the user_id col
        $validated = Arr::add($validated, 'user_id', Auth::id());

        // unset cat key
        unset($validated['cat']);
        //  $validated = Arr::except($validated, ['cat']);

        // insert into database
        Job::create($validated);

        // redirect to index page
        return redirect()->route('jobs.index')->with('success', 'Job listing created successfully');
    }

    /**
     * Show the edit job view
     *
     *@param App\Job - job to edit
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        // prevent users who dont own the job listing
        // from accessing edit page
        if (!$this->checkIfUser($job->user_id)) {
            return back()->with('error', 'You cant perform this action');
        }

        return view('wera.edit')->with([
            'job' => $job,
            'categories' => $this->getCategories()
        ]);
    }
    
    /**
     * Update a job listing
     *
     * @param App\Job $job - job to update
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Job $job)
    {
        // prevent users who dont own the job listing
        // from updating the job
        if (!$this->checkIfUser($job->user_id)) {
            return back()->with('error', 'You cant perform this action');
        }
        // validate user input
        $validated = request()->validate([
            'title' => 'required|min: 3',
            'company' => 'required|min: 3',
            'cat' => 'required',
            'summary' => 'required',
            'description' => 'required',
            'contact_name' => 'required|min: 3',
            'contact_email' => 'required|email'
        ]);

        // append cateogry_id key and give it value of $val['cat']
        $validated = Arr::add($validated, 'category_id', $validated['cat']);
        
        // unset cat key
        unset($validated['cat']);
       
        // update job listing
        $job->update($validated);

        // redirect to index page
        return redirect()->route('jobs.index')->with('success', 'Job listing updated successfully');
    }

    /**
     * Delete a job listing
     *
     * @param App\Job $job - job to delete
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        // prevent users who dont own the job listing
        // from deleting the job listing
        if (!$this->checkIfUser($job->user_id)) {
            return back()->with('error', 'You cant perform this action');
        }

        // delete the job listing
        $job->delete();

        // redirect user
        // redirect to index page
        return redirect()->route('jobs.index')->with('success', 'Job listing deleted successfully');
    }

    /**
     * Fetch all categories
     *
     * @return \Illuminate\Database\Eloquent
     */
    private function getCategories()
    {
        return Category::orderBy('title', 'ASC')->get();
    }

    /**
     * Check if logged in user id matches $id
     *
     * @param  int $id
     *
     * @return bool
     */
    private function checkIfUser($id)
    {
        return (Auth::id() == $id) ? true : false;
    }
}
