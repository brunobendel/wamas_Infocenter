@extends('welcome')

@section('title', 'WAMAS LogiMat Infocenter')

@section('content')
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-danger mb-0">WAMAS <span class="text-dark">LogiMat Infocenter 2.0</span></h3>
        <div class="d-flex gap-2">
            @auth
                <span class="badge bg-info text-dark">{{ Auth::user()->name }}</span>
                @if((Auth::user()->role ?? 'client') === 'admin')
                    <a href="{{ route('settings.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-cog"></i> Configurações
                    </a>
                @endif
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        <i class="fas fa-sign-out-alt"></i> Sair
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-sign-in-alt"></i> Entrar
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-user-plus"></i> Registrar
                    </a>
                @endif
            @endauth
        </div>
    </div>

    <!-- Ferramentas -->
    <div class="mb-5">
        <h4 class="mb-3">Ferramentas</h4>
        <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-4">
            @forelse($visibleTools as $tool)
                <div class="col">
                    @php
                        $url = match($tool->tool_name) {
                            'integracao' => route('integracao.index'),
                            'importacao_planilha' => url('/importar-excel'),
                            default => '#'
                        };
                        $shouldLink = in_array($tool->tool_name, ['integracao', 'importacao_planilha']);
                    @endphp
                    
                    @if($shouldLink)
                        <a href="{{ $url }}" style="text-decoration: none; color: inherit;">
                    @endif
                    
                    <div class="card card-tool text-center p-3 h-100">
                        <img src="{{ $tool->icon_path }}" class="mx-auto" alt="{{ $tool->tool_label }}" style="max-height: 50px; width: auto;">
                        <p class="mt-3">{{ $tool->tool_label }}</p>
                    </div>
                    
                    @if($shouldLink)
                        </a>
                    @endif
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        Nenhuma ferramenta visível. Acesse as <a href="{{ route('settings.index') }}">configurações</a> para ativar ferramentas.
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Relatórios Rápidos -->
    {{-- <div>
        <h4 class="mb-3">Relatórios rápidos</h4>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card card-report text-center p-3 h-100">
                    <p>Movimentação do Item</p>
                    <input type="text" class="form-control" placeholder="Número do item...">
                    <br><br>
                    <button type="button" class="btn btn-success">Gerar Relatório</button>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-report text-center p-3 h-100">
                    <p>Movimentação do Pedido</p>
                    <input type="text" class="form-control" placeholder="Número do pedido...">
                    <br><br>
                    <button type="button" class="btn btn-success">Gerar Relatório</button>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-report text-center p-3 h-100">
                    <p>Movimentação por Período</p>
                    <input type="date" class="form-control mb-2" placeholder="Data Inicial">
                    <input type="date" class="form-control" placeholder="Data Final">
                    <button type="button" class="btn btn-success">Gerar Relatório</button>
                </div>
            </div>
        </div>
    </div> --}}
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@endsection