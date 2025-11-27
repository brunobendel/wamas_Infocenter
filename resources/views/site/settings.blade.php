@extends('welcome')

@section('title', 'Configurações - WAMAS LogiMat')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <!-- Nav Tabs -->
            <ul class="nav nav-tabs mb-4" id="settingsTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="ferramentas-tab" data-bs-toggle="tab" data-bs-target="#ferramentas-pane" type="button" role="tab">
                        <i class="fas fa-wrench"></i> Ferramentas
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="servidor-tab" data-bs-toggle="tab" data-bs-target="#servidor-pane" type="button" role="tab">
                        <i class="fas fa-server"></i> Servidor
                    </button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="settingsTabContent">
                <!-- Aba Ferramentas -->
                <div class="tab-pane fade show active" id="ferramentas-pane" role="tabpanel" tabindex="0">
                    <h2 class="mb-4 fw-bold text-danger">
                        <i class="fas fa-cog"></i> Configurações de Ferramentas
                    </h2>
                    <p class="text-muted mb-4">Clique no toggle para mostrar ou ocultar cada ferramenta na tela inicial</p>

                    <div class="list-group">
                        @foreach($tools as $tool)
                            <div class="list-group-item d-flex justify-content-between align-items-center p-4">
                                <div class="d-flex align-items-center gap-3">
                                    @if($tool->icon_path)
                                        <img src="{{ $tool->icon_path }}" alt="{{ $tool->tool_label }}" style="height: 40px; width: auto;">
                                    @else
                                        <div style="height: 40px; width: 40px; background-color: #e9ecef; border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-cube text-muted"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <h5 class="mb-0">{{ $tool->tool_label }}</h5>
                                        <small class="text-muted">{{ $tool->tool_name }}</small>
                                    </div>
                                </div>
                                
                                <div class="form-check form-switch">
                                    <input 
                                        class="form-check-input tool-toggle" 
                                        type="checkbox" 
                                        id="toggle-{{ $tool->id }}"
                                        data-tool-name="{{ $tool->tool_name }}"
                                        {{ $tool->is_visible ? 'checked' : '' }}
                                        style="cursor: pointer; width: 3em; height: 1.5em;"
                                    >
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Aba Servidor -->
                <div class="tab-pane fade" id="servidor-pane" role="tabpanel" tabindex="0">
                    <h2 class="mb-4 fw-bold text-danger">
                        <i class="fas fa-server"></i> Configurações de Servidor
                    </h2>
                    <p class="text-muted mb-4">Configure os endpoints e credenciais do seu servidor de banco de dados</p>

                    <div class="card">
                        <div class="card-header bg-danger text-white">
                            <h5 class="mb-0">Conexão com Banco de Dados</h5>
                        </div>
                        <div class="card-body">
                            <form id="form-server-settings">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">DB Engine</label>
                                        <input type="text" class="form-control server-input" data-key="db_engine" value="{{ $serverSettings->where('key', 'db_engine')->first()?->value }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">DB Server</label>
                                        <input type="text" class="form-control server-input" data-key="db_server" value="{{ $serverSettings->where('key', 'db_server')->first()?->value }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">DB Port</label>
                                        <input type="number" class="form-control server-input" data-key="db_port" value="{{ $serverSettings->where('key', 'db_port')->first()?->value }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">DB Instance</label>
                                        <input type="text" class="form-control server-input" data-key="db_instance" value="{{ $serverSettings->where('key', 'db_instance')->first()?->value }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">DB Username</label>
                                        <input type="text" class="form-control server-input" data-key="db_username" value="{{ $serverSettings->where('key', 'db_username')->first()?->value }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">DB Password</label>
                                        <input type="password" class="form-control server-input" data-key="db_password" value="{{ $serverSettings->where('key', 'db_password')->first()?->value }}">
                                    </div>
                                </div>

                                <hr>

                                <h5 class="mb-3 text-secondary">WAMAS Databases</h5>

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">WAMAS Production DB</label>
                                        <input type="text" class="form-control server-input" data-key="wamas_prod" value="{{ $serverSettings->where('key', 'wamas_prod')->first()?->value }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">WAMAS View DB</label>
                                        <input type="text" class="form-control server-input" data-key="wamas_view" value="{{ $serverSettings->where('key', 'wamas_view')->first()?->value }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">WAMAS Archive DB</label>
                                        <input type="text" class="form-control server-input" data-key="wamas_arch" value="{{ $serverSettings->where('key', 'wamas_arch')->first()?->value }}">
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save"></i> Salvar Configurações
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ url('/') }}" class="btn btn-secondary">Voltar à Home</a>
            </div>
        </div>
    </div>
</div>

<style>
    .list-group-item {
        border-left: 4px solid transparent;
        transition: all 0.3s ease;
    }
    
    .list-group-item:hover {
        background-color: #f8f9fa;
        border-left-color: #dc3545;
    }

    .nav-link {
        cursor: pointer;
        color: #6c757d;
    }

    .nav-link.active {
        color: #dc3545;
        border-color: #dc3545;
    }

    .nav-link:hover {
        color: #dc3545;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggles de ferramentas
    document.querySelectorAll('.tool-toggle').forEach(toggle => {
        toggle.addEventListener('change', async function() {
            const toolName = this.getAttribute('data-tool-name');
            
            try {
                const response = await fetch('{{ url("/api/settings/toggle") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        tool_name: toolName
                    })
                });
                
                const data = await response.json();
                
                if (!data.success) {
                    this.checked = !this.checked;
                    alert('Erro ao atualizar configuração');
                }
            } catch (error) {
                console.error('Erro:', error);
                this.checked = !this.checked;
                alert('Erro ao atualizar configuração');
            }
        });
    });

    // Salvar configurações de servidor
    const formServerSettings = document.getElementById('form-server-settings');
    if (formServerSettings) {
        formServerSettings.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const inputs = document.querySelectorAll('.server-input');
            let count = 0;
            let totalInputs = inputs.length;

            inputs.forEach(input => {
                const key = input.getAttribute('data-key');
                const value = input.value;

                fetch('{{ url("/api/settings/server") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        key: key,
                        value: value
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Resposta:', data);
                    count++;
                    if (count === totalInputs) {
                        alert('Todas as configurações foram salvas com sucesso!');
                    }
                })
                .catch(error => {
                    console.error('Erro:', error);
                    count++;
                });
            });
        });
    } else {
        console.error('Formulário form-server-settings não encontrado');
    }
});
</script>
@endsection
