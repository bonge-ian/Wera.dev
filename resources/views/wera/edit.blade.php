@extends('layouts.app')

@section('title', 'Create Job')

@section('content')
    <section class="uk-section" id="create">
        <div class="uk-container uk-container-small">
            <form class="uk-form-stacked uk-box-shadow-medium uk-padding" method="post" action="{{ route('jobs.update', $job->id) }}">
               <h2>Create Job Listing</h2>
                @csrf
                @method('PATCH')
                @if($errors->any())
                     <div class="uk-alert-danger uk-margin-small" uk-alert>
                        <div class="uk-text-bold">
                            There are some errors in your form application.<br>
                            Please check and resubmit the form
                        </div>
                        
                    </div>
                @endif
               <div class="uk-margin-small">
                   <label for="title" class="uk-form-label">Job Title</label>
                   <input type="text" name="title" id="title" class="uk-input @error('title') uk-form-danger @enderror " required autofocus placeholder="Business Admin" value="{{ old('title') ?? $job->title }}">
                   @error('title')
                        <div class="uk-alert-danger uk-margin-small" uk-alert>
                            {{ $errors->first('title') }}
                        </div>
                   @enderror
               </div>
               <div class="uk-margin-small">
                   <label for="company" class="uk-form-label">Company</label>
                   <input type="text" name="company" id="company" class="uk-input @error('company') uk-form-danger @enderror" required placeholder="Wakora Associates & Co." value="{{ old('company') ?? $job->company }}">
                   @error('company')
                        <div class="uk-alert-danger uk-margin-small" uk-alert>
                            {{ $errors->first('company') }}
                        </div>
                   @enderror
               </div>
                <div class="uk-margin-small">
                   <label for="company" class="uk-form-label">Job Category</label>
                   <select name="cat" id="" class="uk-select" required>
                        <option value="{{ $job->category_id }}">{{ $job->category->title }}</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                   @error('cat')
                        <div class="uk-alert-danger uk-margin-small" uk-alert>
                            {{ $errors->first('cat') }}
                        </div>
                   @enderror
               </div>
               <div class="uk-margin-small">
                   <label for="summary" class="uk-form-label">Job Summary Description</label>
                   <textarea name="summary" id="summary" rows="3" class="uk-textarea  @error('summary') uk-form-danger @enderror " required placeholder="Type a summary about the job here">{{ old('summary') ?? $job->summary  }}</textarea>
                   @error('summary')
                        <div class="uk-alert-danger uk-margin-small" uk-alert>
                            {{ $errors->first('summary') }}
                        </div>
                   @enderror
               </div>
               <div class="uk-margin-small">
                   <label for="description" class="uk-form-label">Job Description</label>
                   <textarea name="description" id="desc" rows="3" class="uk-textarea @error('description') uk-form-danger @enderror " required placeholder="Enter the job Description here">{{ old('description') ?? $job->description }}</textarea>
                   @error('description')
                        <div class="uk-alert-danger uk-margin-small" uk-alert>
                            {{ $errors->first('description') }}
                        </div>
                   @enderror
               </div>
               <div class="uk-child-width-1-2@s uk-margin-small" uk-grid>
                   <div class="">
                       <label for="name" class="uk-form-label">Contact Name</label>
                       <input type="text" name="contact_name" id="name" class="uk-input @error('contact_name') uk-form-danger @enderror " required placeholder="Mrs. Wamushomba Mbugus" value="{{ old('contact_name') ?? $job->contact_name }}">
                       @error('contact_name')
                            <div class="uk-alert-danger uk-margin-small" uk-alert>
                                {{ $errors->first('contact_name') }}
                            </div>
                       @enderror
                   </div>
                   <div class="">
                       <label for="contact_email" class="uk-form-label">Contact Email</label>
                       <input type="email" name="contact_email" id="email" class="uk-input @error('contact_email') uk-form-danger @enderror " required placeholder="wamushomba@wakora.co.ke" value="{{ old('contact_email') ?? $job->contact_email }}">
                       @error('contact_email')
                            <div class="uk-alert-danger uk-margin-small" uk-alert>
                                {{ $errors->first('contact_email') }}
                            </div>
                       @enderror
                   </div>
               </div>

               <button type="submit" class="uk-align-center uk-width-1-2@m uk-button btn">Update</button>

            </form>
        </div>
    </section>

@endsection
