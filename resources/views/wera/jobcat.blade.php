@extends('layouts.app')

@section('title', 'Jobs')

@section('content')
    <section id="index">
        <div class="uk-section uk-padding" id="hero">
            <div class="uk-container">

                <div class="uk-width-3-4@m uk-align-center">
                    
                    <form action="{{ route('jobs.cat')  }}" method="get"  class="uk-margin-medium-top">
                        <select name="cat" id="" class="uk-select">
                            <option value="0">Choose a category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="uk-align-center uk-button uk-button-large uk-button-primary">Browse Category</button>
                    </form>
                </div>

            </div>
        </div>
        
        <div class="uk-section uk-padding" id="jobs">
                 <a href="{{ URL::previous() }}" class="uk-button btn">Go Back</a>
                @forelse ($jobs as $job)
               
                <div class="uk-card uk-card-body uk-box-shadow-small uk-margin-small">
                    <h4 class="uk-card-title uk-heading-divider uk-margin-remove-bottom">{{ $job->title }}</h4>
                    <small class="company uk-text-small">Company: {{ $job->company }}</small>
                    <div class="uk-flex-middle uk-flex uk-flex-wrap " uk-grid>
                        <div class="uk-width-4-5@m uk-flex-first ">
                            <p>{{ $job->summary }}</p>
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
                                <p class="uk-text-center uk-text-large uk-margin-remove-bottom">Sorry! There are no job listings matching this category at the moment.</p>
                                <p class="uk-text-center uk-text-large uk-margin-remove-top">Please try again later.</p>
                                <a href="{{ URL::previous() }}"><p class="uk-text-center uk-text-large">Go Back</p></a>
                            </div>
                        </div>
                    </div>
                @endforelse
                {{ $jobs->appends(['cat' => $cat])->links() }}
                
   
        </div>
    </section>
@endsection
