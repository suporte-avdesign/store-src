@component('mail::message')
# Olá {{$user->first_name}}

Seu cadastro ainda não foi concluído! .
Para ativa-lo agora, basta clicar no botão "Concluir Cadastro".

@component('mail::button', ['url' => $url])
    Concluir Cadastro
@endcomponent

Obrigado,<br>
{{ config('app.name') }}<br>
{{ env('DT_PHONE') }}
@endcomponent