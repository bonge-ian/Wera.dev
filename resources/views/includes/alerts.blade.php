
@if (session('success'))
     <div class="uk-alert-success uk-animation-slide-top uk-align-center uk-width-@s uk-margin-top" uk-alert="animation: uk-animation-slide-bottom; duration: 1000">
        <a class="uk-alert-close" uk-close></a>
        <p>{{ session('success') }}</p>
    </div>
@endif

@if (session('warning'))
     <div class="uk-alert-warning uk-animation-slide-top uk-align-center uk-width-@s uk-margin-top" uk-alert="animation: uk-animation-slide-bottom; duration: 1000">
        <a class="uk-alert-close" uk-close></a>
        <p>{{ session('warning') }}</p>
    </div>
@endif

@if (session('error'))
     <div class="uk-alert-danger uk-animation-slide-top uk-align-center uk-width-@s uk-margin-top" uk-alert="animation: uk-animation-slide-bottom; duration: 1000">
        <a class="uk-alert-close" uk-close></a>
        <p>{{ session('error') }}</p>
    </div>
@endif
