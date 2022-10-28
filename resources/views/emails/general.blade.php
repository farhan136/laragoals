@component('mail::message')
# {{$title}}

{{$body}}

@component('mail::button', ['url' => $buttonurl])
{{$buttontext}}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
