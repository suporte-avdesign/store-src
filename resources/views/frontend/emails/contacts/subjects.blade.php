@component('mail::message')
# Olá {{$name}}

{{$message}}

Obrigado,<br>
{{ config('app.name') }}<br>
{{ env('DT_PHONE') }}
@endcomponent