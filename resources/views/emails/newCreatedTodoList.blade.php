@component('mail::message')
# New Todo List Created

New Tasks in the road, be prepared !!

@component('mail::button', ['url' => ''])
Check it out!
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
