@extends('layouts.app')

@section('title', 'View Job')

@section('content')
    <section class="uk-section" id="view-job">
        <div class="uk-width-2-3@m uk-align-center">
            <div class="uk-flex uk-flex-between">
                <a href="{{ URL::previous() }}" class="uk-button btn uk-margin-small-bottom">Go Back</a>
                @if(Auth::id() === $job->user_id)
                    <div class="uk-flex uk-flex-end">
                        <a href="{{ route('jobs.edit', $job->id) }}" class="uk-margin-small-right uk-button uk-button-secondary uk-margin-small-bottom">Edit</a>
                    <form action="{{ route('jobs.destroy', $job->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="uk-button btn-d">Delete</button>
                    </form>
                    </div>
                @endif
            </div>
            <div class="uk-box-shadow-large uk-card-body uk-card">
                <div id="top" class="uk-margin-small">
                    <div class="uk-width-1-1 uk-flex uk-flex-between uk-flex-wrap">
                        <h3 class="uk-text-break uk-margin-small uk-heading-small">{{ $job->title  }}</h3>
                       @if ($job->created_at->diffInDays(now()) < 1)
                            <div>
                                <span class="uk-label uk-label-success uk-border-pill" id="new">New</span>
                            </div>
                        @endif
                    </div>
            
                    <p class="uk-margin-small"><span class="uk-text-muted">Company:</span> <span class="uk-text-bold uk-text-primary">{{ $job->company }}</span></p>
                    <p class="uk-margin-small"><span class="uk-text-muted">Category:</span> <span class="uk-text-bold uk-text-primary">{{ $job->category->title }}</span></p>
                    <small class="uk-margin-small uk-text-bold">Posted on: <span>{{ $job->created_at->diffForHumans() }}</span></small>
                    
                </div>
                <hr>
                <div id="summary" class="uk-margin-small">
                    <h3 class="title">Job Summary</h3>
                    <p>{!! $job->summary !!}</p>
                </div>
                <hr>
                <div id="desc" class="uk-margin-small">
                    <h3 class="title">Job Description</h3>
                    <p class="uk-margin-small-bottom">{!! $job->description !!}</p>
                    @if (Auth::id() !== $job->user_id)
                        <a href="{{ route('jobs.apply', $job->id)  }}" class="uk-button uk-button-primary ">Apply</a>
                    @endif
                    <hr>
                    <div class="uk-flex uk-flex-wrap">
                        <div class="uk-margin-small-right">Contact Name: <span class="uk-text-bold uk-text-primary">{{ $job->contact_name }}</span></div>
                        <div>Contact Email: <span class="uk-text-bold uk-text-primary">{{ $job->contact_email }}</span></div>

                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection
