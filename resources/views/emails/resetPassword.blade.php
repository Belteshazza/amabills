@component('mail::message')
# Welcome to amabills

Hello this is your token.
{{$data}}

@component('mail::button', ['url' => 'https://amabills.com/'])
Reset password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent