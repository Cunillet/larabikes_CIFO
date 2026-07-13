@component('mail::layout')
{{-- Header --}}
@slot('header')
    @component('mail::header', ['url' => config('app.url')])
        {{ config('app.name') }}
    @endcomponent
@endslot

{{-- Body --}}
# ¡Hola {{ $user->name }}!

Has recibido este correo porque hemos recibido una solicitud de restablecimiento de contraseña para tu cuenta en **{{ $appName }}**.

Si no solicitaste el restablecimiento, ignora este mensaje.

@component('mail::button', ['url' => $url, 'color' => 'success'])
    🔄 Restablecer Contraseña
@endcomponent

⏱️ Este enlace expirará en **{{ $expire }} minutos**.

🔒 Por seguridad, no compartas este enlace con nadie.

{{-- Footer --}}
@slot('footer')
    @component('mail::footer')
        © {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.
    @endcomponent
@endslot
@endcomponent