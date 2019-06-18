@extends('layouts.app')

@section('title', 'Jobs')

@section('content')
    <section id="index">
        <div class="uk-section uk-padding" id="hero">
            <div class="uk-container uk-container-center">

                <div class="uk-width-3-4@m uk-align-center">
                    <h2 class="uk-text-center uk-heading-large uk-margin-remove-bottom">Welcome to Wera</h2>
                    <div class="uk-text-primary uk-text-lead  uk-text-center">The best platform for job-seekers</div>
                    <form action="{{ route('jobs.cat')  }}" method="get"  class="uk-margin-medium-top">
                        <select name="cat" id="" class="uk-select">
                            <option value="0">Choose a category</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="uk-align-center uk-button uk-button-large uk-button-primary">Browse Category</button>
                    </form>
                </div>

            </div>
        </div>
        
        <div class="uk-section uk-padding" id="jobs">
            <h2 class="uk-heading-small uk-heading-bullet">Latest Jobs</h2>
                 
                @forelse ($jobs as $job)
                <div class="uk-card uk-card-body uk-box-shadow-small uk-margin-small">
                    <div class="uk-width-1-1 uk-flex uk-flex-between uk-heading-divider uk-flex-wrap">
                        <h4 class="uk-card-title  uk-margin-remove-bottom">{{ $job->title }}</h4>
                       @if ($job->created_at->diffInDays(now()) < 1)
                            <div>
                                <span class="uk-label uk-label-success uk-border-pill" id="new">New</span>
                            </div>
                        @endif
                    </div>
                    <small class="company uk-text-small">Company: {{ $job->company }}</small>
                    <div class="uk-flex-middle uk-flex uk-flex-wrap " uk-grid>
                        <div class="uk-width-4-5@m uk-flex-first ">
                            <p>{!! $job->summary !!}</p>
                        </div>
                        <div class="uk-width-1-5@m">
                            <a href="{{ route('jobs.view', $job->id) }}" class=" uk-button uk-button-secondary" id="det">Details</a>
                        </div>
                        
                    </div>
                    <hr class="uk-margin-remove-bottom">
                    <small class="uk-text-meta uk-margin-small-right">Category: <span class="uk-text-bold">{{ $job->category->title }}</span></small>
                </div>
                @empty
                    <div class="uk-width-2-3@m uk-align-center">
                        <div class="uk-alert-danger" uk-alert>
                            <div class="uk-card  uk-card-body">
                                <p class="uk-text-center uk-text-large">Sorry! There are no job listings at the moment.</p>
                                <p class="uk-text-center uk-text-large">Please try again later.</p>
                            </div>
                        </div>
                    </div>
                @endforelse
                {{ $jobs->links() }}
                
   
        </div>
    </section>
@endsection
