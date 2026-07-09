<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index() {
        return view('contacts.index');
    }

    public function send(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:200',
            'message' => 'required|string|max:5000',
            'document' => 'nullable|file|mimes:pdf|max:5120', // 5MB max
        ]);
        
        // Procesar el documento si existe
        if ($request->hasFile('document')) {
            $path = $request->file('document')->store('contact_documents', 'public');
            // Guardar $path en la base de datos
        }
        
        // Enviar email (opcional)
        Mail::to(config('mail.from.address'))->send(new ContactMail($validated));
        
        return redirect()->route('contact')
            ->with('success', 'Mensaje enviado correctamente. ¡Te responderemos pronto!');
    }
}
