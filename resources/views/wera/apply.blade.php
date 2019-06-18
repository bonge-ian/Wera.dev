@extends('layouts.app')

@section('title', 'Apply Job')

@section('content')
    <section class="uk-section" id="apply-job">
      
        <div class="uk-width-2-3@m uk-align-center uk-box-shadow-medium">

            <form enctype="multipart/form-data" action="{{route('jobs.apply.submit', $job->id)}}" class=" uk-form-stacked uk-padding" method="post">
                 <h2>Apply for Job</h2>
                  @if($errors->any())
                     <div class="uk-alert-danger uk-margin-small" uk-alert>
                        <div class="uk-text-bold">
                            There are some errors in your form application.<br>
                            Please check and resubmit the form
                        </div>
                        
                    </div>
                @endif
                @csrf
                <div class="uk-child-width-1-2@s uk-grid-small uk-margin-small-bottom" uk-grid>
                    <div>
                        <label for="firstname" class="uk-form-label">Firstname</label>
                        <input type="text" name="firstname" id="firstname" class="uk-input @error('firstname') uk-form-error @enderror" required autofocus placeholder="Kariuki">
                        @error('firstname') 
                            <div class="uk-alert-danger uk-margin-small" uk-alert>
                                {{ $errors->first('firstname') }}
                            </div>
                        @enderror
                    </div>
                    <div>
                        <label for="lastname" class="uk-form-label">Lastname</label>
                        <input type="text" name="lastname" id="lastname" class="uk-input @error('lastname') uk-form-danger @enderror" required placeholder="Wachira">
                        @error('lastname') 
                            <div class="uk-alert-danger uk-margin-small" uk-alert>
                                {{ $errors->first('lastname') }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="uk-margin">
                    <label for="email" class="uk-form-label">Email</label>
                    <input type="email" name="email" id="email" class="uk-input @error('email') uk-form-danger @enderror" required placeholder="wachira@gmail.com">
                    @error('email') 
                        <div class="uk-alert-danger uk-margin-small" uk-alert>
                            {{ $errors->first('email') }}
                        </div>
                    @enderror
                </div>
                <div class="uk-margin">
                    <label for="exp" class="uk-form-label">Experience</label>
                    <select name="experience" id="exp" class="uk-select @error('experience') uk-form-danger @enderror" required>
                        <option value="">Experience level</option>
                        <option value="1">Less than one year</option>
                        <option value="2">One year</option>
                        <option value="3">Two years</option>
                        <option value="4">3-4 years</option>
                        <option value="5">5 years</option>
                        <option value="6">Over 5 years</option>
                    </select>
                     @error('experience') 
                        <div class="uk-alert-danger uk-margin-small" uk-alert>
                            {{ $errors->first('experience') }}
                        </div>
                    @enderror
                </div>
                <div class="uk-margin">
                    <label for="avail" class="uk-form-label @error('availability') uk-form-danger @enderror">Availability</label>
                    <select name="availability" id="avail" class="uk-select" required>
                        <option value="">Availability</option>
                        <option value="1">Immediately</option>
                        <option value="2">One Week</option>
                        <option value="3">Two Weeks</option>
                        <option value="4">3 Weeks</option>
                        <option value="5">One month</option>
                    </select>
                    @error('availability') 
                        <div class="uk-alert-danger uk-margin-small" uk-alert>
                            {{ $errors->first('availability') }}
                        </div>
                    @enderror
                </div>
                <div class="uk-margin">
                    <label for="message" class="uk-form-label">Cover Letter</label>
                    <textarea name="message" id="message" rows="3" class="uk-textarea @error('message') uk-form-danger @enderror" required placeholder="Your Cover Letter goes here">Your Cover Letter goes here.</textarea>
                    @error('message') 
                        <div class="uk-alert-danger uk-margin-small" uk-alert>
                            {{ $errors->first('message') }}
                        </div>
                    @enderror
                </div>
                <div class="uk-margin">
                    <div uk-form-custom="target: true">
                        <input type="file" name="resume" class="@error('resume') uk-form-danger @enderror" required>
                        <input class="uk-input uk-form-width-medium" type="text" placeholder="Upload your resume" disabled>
                    </div>
                    
                    @error('resume') 
                        <div class="uk-alert-danger uk-margin-small" uk-alert>
                              {{ $errors->first('resume') }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="uk-button btn">Apply</button>
            </form>
        </div>

    </section>
@endsection
