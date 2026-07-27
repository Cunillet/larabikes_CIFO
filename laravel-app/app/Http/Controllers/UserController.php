<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Mostrar el perfil del usuario.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $user = Auth::user();
        
        return view('profile.show', compact('user'));
    }

    /**
     * Mostrar el formulario para editar el perfil.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $user = Auth::user();
        $countries = Country::orderBy('name')->get();
        
        return view('profile.edit', ['user' => $user, 'countries' => $countries]);
    }

    public function confirmEmail(Request $request) {
        $request->user()->sendEmailVerificationNotification(); // <-- Se llama aquí
        return back()->with('message', '¡Enlace de verificación reenviado!');
    }
}
