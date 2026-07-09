{{-- resources/views/contact.blade.php --}}

@extends('template.master') 
@section('title', 'Bikes List')

@section('breadcrumbs-items')
    <li class="breadcrumb-item active" aria-current="page">Contacto</li>
@endsection

@section('content')
<div class="container py-4 mb-5">
    <div class="row mb-5">
        <!-- Columna principal -->
        <div class="col-lg-8">
            <h1 class="display-4 fw-bold mb-2">Contacto</h1>
            
            <!-- Estadísticas -->
            <p class="lead mb-4">
                Contamos con <strong>94 motos</strong> en nuestro garaje, con un precio promedio de <strong>20,696.82 €</strong>
            </p>
            
            <hr class="border-secondary mb-4">
            
            <!-- Formulario de contacto -->
            <form action="{{ route('contacts.send') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row g-3">
                    <!-- Nombre -->
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nombre:</label>
                        <input type="text" 
                               class="form-control bg-dark text-light border-secondary @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}"
                               placeholder="Tu nombre"
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Email -->
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" 
                               class="form-control bg-dark text-light border-secondary @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}"
                               placeholder="tu@email.com"
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Asunto -->
                    <div class="col-12">
                        <label for="subject" class="form-label">Asunto:</label>
                        <input type="text" 
                               class="form-control bg-dark text-light border-secondary @error('subject') is-invalid @enderror" 
                               id="subject" 
                               name="subject" 
                               value="{{ old('subject') }}"
                               placeholder="Asunto del mensaje"
                               required>
                        @error('subject')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Mensaje -->
                    <div class="col-12">
                        <label for="message" class="form-label">Mensaje:</label>
                        <textarea class="form-control bg-dark text-light border-secondary @error('message') is-invalid @enderror" 
                                  id="message" 
                                  name="message" 
                                  rows="5"
                                  placeholder="Escribe tu mensaje aquí..."
                                  required>{{ old('message') }}</textarea>
                        @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Documento PDF -->
                    <div class="col-12">
                        <label for="document" class="form-label">Documento PDF:</label>
                        <input type="file" 
                               class="form-control bg-dark text-light border-secondary @error('document') is-invalid @enderror" 
                               id="document" 
                               name="document" 
                               accept=".pdf"
                               aria-describedby="documentHelp">
                        <div id="documentHelp" class="form-text text-secondary">
                            Opcional. Solo se admiten archivos PDF.
                        </div>
                        @error('document')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Botón de envío -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-lg px-5">
                            Enviar mensaje
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Sidebar -->
        <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="card bg-secondary bg-opacity-25 border-secondary">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-3">CIFO Sabadell</h5>
                    
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="bi bi-geo-alt-fill text-primary me-2"></i>
                            <strong>CIFO Valles</strong>
                            <br>
                            <span class="text-secondary ms-4">08227 Terrassa, Barcelona</span>
                            <br>
                            <span class="text-warning ms-4">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                                3,8 ★ (13)
                            </span>
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-geo-alt text-secondary me-2"></i>
                            UPG ecoRacing
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-geo-alt text-secondary me-2"></i>
                            Parking Pi Hospital de Terrassa
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-geo-alt text-secondary me-2"></i>
                            eFOValles
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-geo-alt text-secondary me-2"></i>
                            Instituto Castel For
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-geo-alt text-secondary me-2"></i>
                            Mercavalles
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-geo-alt text-secondary me-2"></i>
                            Expocaravan M1 Terrassa
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-geo-alt text-secondary me-2"></i>
                            Hercal Diggers
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-geo-alt text-secondary me-2"></i>
                            Google
                        </li>
                    </ul>
                    
                    <hr class="border-secondary">
                    
                    <p class="text-secondary mb-0">
                        <i class="bi bi-geo-alt-fill text-primary me-2"></i>
                        Carretera Nacional 150 km.15, 08227 Terrassa
                    </p>
                </div>
            </div>
            
            <!-- Información adicional -->
            <div class="card bg-secondary bg-opacity-25 border-secondary mt-3">
                <div class="card-body">
                    <h6 class="fw-bold mb-2">¿Necesitas ayuda?</h6>
                    <p class="text-secondary small mb-0">
                        <i class="bi bi-envelope me-2"></i>
                        <a href="mailto:{{ config('mail.from.address') }}" class="text-decoration-none text-light">
                            {{ config('mail.from.address') }}
                        </a>
                        <br>
                        <i class="bi bi-clock me-2"></i>
                        Lunes a Viernes, 9:00 - 18:00
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
{{-- Si necesitas estilos adicionales --}}
<style>
    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    
    .form-control::placeholder {
        color: #6c757d;
        opacity: 0.6;
    }
    
    .bi {
        font-size: 1.1rem;
    }
    
    /* Ajuste para input file en modo oscuro */
    input[type="file"].form-control {
        padding: 0.375rem 0.75rem;
    }
    
    input[type="file"].form-control::file-selector-button {
        background-color: #0d6efd;
        color: white;
        border: none;
        padding: 0.375rem 0.75rem;
        border-radius: 0.25rem;
        margin-right: 1rem;
        cursor: pointer;
        transition: background-color 0.2s;
    }
    
    input[type="file"].form-control::file-selector-button:hover {
        background-color: #0b5ed7;
    }
</style>
@endpush

@push('scripts')
{{-- Bootstrap Icons CDN --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endpush