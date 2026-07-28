
<x-mail::message>
# Nuevo usuario registrado

Se ha registrado un nuevo usuario en el sistema.

**Detalles del usuario:**
- **Nombre:** {{ $userName }}
- **Email:** {{ $userEmail }}
- **Registrado el:** {{ $registeredAt }}

<x-mail::button :url="config('app.url') . '/admin/users'">
Ver usuarios
</x-mail::button>

Saludos,<br>
{{ config('app.name') }}
</x-mail::message>
