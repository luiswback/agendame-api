<p>Olá, {{$user->first_name}}</p>
<p>Seja bem vindo ao AgendaME</p>
<a href="{{config('app.frontend_url')}}/verify-email?token={{$user->token}}">Verificar email</a>
