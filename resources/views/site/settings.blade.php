@extends('welcome')

@section('title', 'Configurações - WAMAS LogiMat')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <!-- Nav Tabs -->
            <ul class="nav nav-tabs mb-4" id="settingsTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="servidor-tab" data-bs-toggle="tab" data-bs-target="#servidor-pane" type="button" role="tab">
                        <i class="fas fa-server"></i> Servidor
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="permissoes-tab" data-bs-toggle="tab" data-bs-target="#permissoes-pane" type="button" role="tab">
                        <i class="fas fa-lock"></i> Permissões
                    </button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="settingsTabContent">
                <!-- Ferramentas removidas: agora apenas Servidor e Permissões -->

                <!-- Aba Servidor -->
                <div class="tab-pane fade show active" id="servidor-pane" role="tabpanel" tabindex="0">
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
                                        <input type="text" class="form-control server-input" data-key="db_engine" value="{{ $currentConfig['db_engine'] ?? '' }}">
                                        <small class="text-muted">Atual: {{ $currentConfig['db_engine'] ?? 'não definido' }}</small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">DB Server</label>
                                        <input type="text" class="form-control server-input" data-key="db_server" value="{{ $currentConfig['db_server'] ?? '' }}">
                                        <small class="text-muted">Atual: {{ $currentConfig['db_server'] ?? 'não definido' }}</small>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">DB Port</label>
                                        <input type="number" class="form-control server-input" data-key="db_port" value="{{ $currentConfig['db_port'] ?? '' }}">
                                        <small class="text-muted">Atual: {{ $currentConfig['db_port'] ?? 'não definido' }}</small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">DB Instance</label>
                                        <input type="text" class="form-control server-input" data-key="db_instance" value="{{ $currentConfig['db_instance'] ?? '' }}">
                                        <small class="text-muted">Atual: {{ $currentConfig['db_instance'] ?? 'não definido' }}</small>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">DB Username</label>
                                        <input type="text" class="form-control server-input" data-key="db_username" value="{{ $currentConfig['db_username'] ?? '' }}">
                                        <small class="text-muted">Atual: {{ $currentConfig['db_username'] ?? 'não definido' }}</small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">DB Password</label>
                                        <input type="password" class="form-control server-input" data-key="db_password" value="{{ $currentConfig['db_password'] ?? '' }}">
                                        <small class="text-muted">Atual: {{ $currentConfig['db_password'] ? '***' : 'não definido' }}</small>
                                    </div>
                                </div>

                                <hr>

                                <h5 class="mb-3 text-secondary">WAMAS Databases</h5>

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">WAMAS Production DB</label>
                                        <input type="text" class="form-control server-input" data-key="wamas_prod" value="{{ $currentConfig['wamas_prod'] ?? '' }}">
                                        <small class="text-muted">Atual: {{ $currentConfig['wamas_prod'] ?? 'não definido' }}</small>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">WAMAS View DB</label>
                                        <input type="text" class="form-control server-input" data-key="wamas_view" value="{{ $currentConfig['wamas_view'] ?? '' }}">
                                        <small class="text-muted">Atual: {{ $currentConfig['wamas_view'] ?? 'não definido' }}</small>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">WAMAS Archive DB</label>
                                        <input type="text" class="form-control server-input" data-key="wamas_arch" value="{{ $currentConfig['wamas_arch'] ?? '' }}">
                                        <small class="text-muted">Atual: {{ $currentConfig['wamas_arch'] ?? 'não definido' }}</small>
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

                <!-- Aba Permissões -->
                <div class="tab-pane fade" id="permissoes-pane" role="tabpanel" tabindex="0">
                    <h2 class="mb-4 fw-bold text-danger">
                        <i class="fas fa-lock"></i> Permissões por Usuário
                    </h2>

                    <p class="text-muted mb-3">Marque as caixas para permitir que um usuário utilize cada ferramenta.</p>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Usuário</th>
                                    @foreach($tools as $tool)
                                        <th class="text-center">{{ $tool->tool_label }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}<br><small class="text-muted">{{ $user->email }}</small></td>
                                        @foreach($tools as $tool)
                                            @php
                                                $allowed = $permissions[$user->id][$tool->tool_name] ?? false;
                                            @endphp
                                            <td class="text-center">
                                                <input type="checkbox" class="perm-matrix-checkbox" data-user-id="{{ $user->id }}" data-tool-name="{{ $tool->tool_name }}" {{ $allowed ? 'checked' : '' }}>
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
    
    // Permission matrix handlers

    // Permission matrix handlers
    document.querySelectorAll('.perm-matrix-checkbox').forEach(cb => {
        cb.addEventListener('change', async function() {
            const userId = this.getAttribute('data-user-id');
            const toolName = this.getAttribute('data-tool-name');
            const allowed = this.checked;

            try {
                const resp = await fetch('{{ url("/api/settings/permission") }}', {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ user_id: userId, tool_name: toolName, allowed: allowed })
                });

                if (!resp.ok) {
                    const txt = await resp.text().catch(() => 'no body');
                    alert('Erro ao atualizar permissão: ' + resp.status + ' - ' + txt);
                    this.checked = !allowed;
                    return;
                }

                const data = await resp.json().catch(() => null);
                if (!data || !data.success) {
                    alert('Erro ao atualizar permissão');
                    this.checked = !allowed;
                }
            } catch (err) {
                console.error(err);
                alert('Erro ao atualizar permissão');
                this.checked = !allowed;
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

            (async function() {
                for (const input of inputs) {
                    const key = input.getAttribute('data-key');
                    const value = input.value;

                    try {
                        const resp = await fetch('{{ url("/api/settings/server") }}', {
                            method: 'POST',
                            credentials: 'same-origin',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ key: key, value: value })
                        });

                        if (!resp.ok) {
                            const txt = await resp.text().catch(() => 'no body');
                            console.error('Server setting save failed', resp.status, txt);
                            alert('Erro ao salvar configuração: ' + key + ' (' + resp.status + ')');
                            return;
                        }

                        const data = await resp.json().catch(() => null);
                        console.log('Resposta:', data);
                        count++;

                    } catch (err) {
                        console.error('Erro:', err);
                        alert('Erro ao salvar configuração: ' + key);
                        return;
                    }
                }

                if (count === totalInputs) {
                    alert('Todas as configurações foram salvas com sucesso!');
                }
            })();
        });
    } else {
        console.error('Formulário form-server-settings não encontrado');
    }
});
</script>
@endsection
