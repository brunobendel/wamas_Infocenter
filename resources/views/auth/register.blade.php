@extends('welcome')

@section('title', 'Registrar - WAMAS LogiMat')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg rounded-lg">
                <div class="card-header bg-danger text-white">
                    <h3 class="mb-0 text-center">
                        <i class="fas fa-user-plus"></i> Registrar
                    </h3>
                </div>
                <div class="card-body p-5">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Nome Completo</label>
                            <input 
                                type="text" 
                                class="form-control @error('name') is-invalid @enderror" 
                                id="name" 
                                name="name" 
                                value="{{ old('name') }}"
                                required
                                autofocus
                            >
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input 
                                type="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') }}"
                                required
                            >
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">Senha</label>
                            <input 
                                type="password" 
                                class="form-control @error('password') is-invalid @enderror" 
                                id="password" 
                                name="password"
                                required
                            >
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-bold">Confirmar Senha</label>
                            <input 
                                type="password" 
                                class="form-control @error('password_confirmation') is-invalid @enderror" 
                                id="password_confirmation" 
                                name="password_confirmation"
                                required
                            >
                            @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-danger w-100 mb-3">
                            <i class="fas fa-user-plus"></i> Registrar
                        </button>
                    </form>

                    <hr>

                    <p class="text-center text-muted mb-0">
                        Já tem conta? 
                        <a href="{{ route('login') }}" class="text-danger fw-bold">
                            Entre aqui
                        </a>
                    </p>
                </div>
            </div>

            <div class="mt-3 text-center">
                <a href="{{ url('/') }}" class="text-secondary">
                    <i class="fas fa-arrow-left"></i> Voltar à Home
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border: none;
        border-top: 4px solid #dc3545;
    }
</style>
@endsection
