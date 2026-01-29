@extends('welcome')

@section('title', 'Login - WAMAS LogiMat')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg rounded-lg">
                <div class="card-header bg-danger text-white">
                    <h3 class="mb-0 text-center">
                        <i class="fas fa-sign-in-alt"></i> Entrar
                    </h3>
                </div>
                <div class="card-body p-5">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input 
                                type="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') }}"
                                required
                                autofocus
                            >
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
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

                        <button type="submit" class="btn btn-danger w-100 mb-3">
                            <i class="fas fa-sign-in-alt"></i> Entrar
                        </button>
                    </form>

                    <hr>

                    <p class="text-center text-muted mb-0">
                        Não tem conta? 
                        <a href="{{ route('register') }}" class="text-danger fw-bold">
                            Registre-se aqui
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
