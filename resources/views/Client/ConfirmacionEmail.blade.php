@component('mail::message')
# Correo de confirmación

Dear {{$email}},

{{$messages}}


Thanks,<br>
{{ config('app.name') }}
@endcomponent