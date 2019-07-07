@component('mail::message')
# Olá {{$user->first_name}}

## Seu cadastro esta ativo.<br>
Obrigado por nos escolher para desempenhar um papel tão importante. Fazemos sempre o nosso melhor para que nossa relação seja a mais duradoura.

Obrigado,<br>
{{ config('app.name') }}<br>
{{ env('DT_PHONE') }}
@endcomponent
