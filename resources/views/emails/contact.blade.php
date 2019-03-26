@component('mail::message')
# Contato

<div style="padding-top: 5px; padding-bottom: 5px;">
    Nome: {{ $name }}
</div>
<div style="padding-top: 5px; padding-bottom: 5px;">
    Email: {{ $email }}
</div>
<div style="padding-top: 5px; padding-bottom: 5px;">
    Telefone: {{ $phone }}
</div>
<div style="padding-top: 5px; padding-bottom: 5px;">
    Mensagem: {{ $message }}
</div>

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
