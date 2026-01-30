@extends('welcome')

@section('title', 'Integração - WAMAS LogiMat')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-danger mb-0">
                    <i class="fas fa-exchange-alt"></i> Integração
                </h2>
                <a href="{{ url('/') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Voltar
                </a>
            </div>

            <!-- Filtros de Checkbox -->
            <div class="card mb-5">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">Selecione o tipo de integração</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-3 mb-3">
                            <div class="form-check">
                                <input 
                                    class="form-check-input integration-radio" 
                                    type="radio" 
                                    name="integracao"
                                    id="filter-itens"
                                    value="itens"
                                >
                                <label class="form-check-label" for="filter-itens">
                                    <strong><i class="fas fa-box"></i> Itens</strong>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 mb-3">
                            <div class="form-check">
                                <input 
                                    class="form-check-input integration-radio" 
                                    type="radio" 
                                    name="integracao"
                                    id="filter-armazenamento"
                                    value="armazenamento"
                                >
                                <label class="form-check-label" for="filter-armazenamento">
                                    <strong><i class="fas fa-warehouse"></i> Armazenamento</strong>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 mb-3">
                            <div class="form-check">
                                <input 
                                    class="form-check-input integration-radio" 
                                    type="radio" 
                                    name="integracao"
                                    id="filter-picking"
                                    value="picking"
                                >
                                <label class="form-check-label" for="filter-picking">
                                    <strong><i class="fas fa-hand-paper"></i> Picking</strong>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 mb-3">
                            <div class="form-check">
                                <input 
                                    class="form-check-input integration-radio" 
                                    type="radio" 
                                    name="integracao"
                                    id="filter-inventario"
                                    value="inventario"
                                >
                                <label class="form-check-label" for="filter-inventario">
                                    <strong><i class="fas fa-clipboard-list"></i> Inventário</strong>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Conteúdo de Integração -->
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Formulário de Integração</h5>
                </div>
                <div class="card-body">
                    <div id="integracao-content">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> Selecione um tipo de integração acima para exibir o formulário.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-check-input {
        width: 1.25em;
        height: 1.25em;
        cursor: pointer;
    }

    .form-check-label {
        cursor: pointer;
        margin-left: 0.5rem;
        user-select: none;
    }

    .form-check-input:hover {
        background-color: #e7e7e7;
    }

    .form-section {
        padding: 15px;
        background-color: #f8f9fa;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .btn-submit-integracao {
        margin-top: 15px;
    }
</style>

<script>
// Esperar o DOM estar completamente carregado
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeIntegration);
} else {
    // DOM já foi carregado
    initializeIntegration();
}

function initializeIntegration() {
    console.log('=== Inicializando integração ===');
    
    const radios = document.querySelectorAll('.integration-radio');
    console.log('Encontrados ' + radios.length + ' radio buttons');
    
    if (radios.length === 0) {
        console.error('Nenhum radio button encontrado com class "integration-radio"');
        return;
    }
    
    radios.forEach((radio, index) => {
        console.log(`Radio ${index}: ${radio.id} = ${radio.value}`);
        radio.addEventListener('change', function() {
            console.log('>> Radio mudou para: ' + this.value);
            if (this.checked) {
                updateIntegrationForm(this.value);
            }
        });
    });
}

function updateIntegrationForm(tipo) {
    console.log('>>> Atualizando formulário para: ' + tipo);
    const content = document.getElementById('integracao-content');
    
    if (!content) {
        console.error('ERRO: Elemento integracao-content não encontrado!');
        return;
    }

    const formulas = {
        itens: `
            <div class="form-section">
                <h5 class="mb-4"><i class="fas fa-box"></i> Formulário de Integração de Itens</h5>
                <form id="form-integracao-itens">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="itens-sku" class="form-label">SKU/Código do Item</label>
                            <input type="text" class="form-control" id="itens-sku" name="sku" placeholder="Ex: ITEM-001" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="itens-descricao" class="form-label">Descrição</label>
                            <input type="text" class="form-control" id="itens-descricao" name="description" placeholder="Descrição do item" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="itens-unidade" class="form-label">Unidade de Medida</label>
                            <input type="text" class="form-control" id="itens-unidade" name="base_qty_unit" value="PCS" placeholder="Ex: PCS">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="itens-variant" class="form-label">Variante</label>
                            <input type="text" class="form-control" id="itens-variant" name="variant" value="00000" placeholder="Ex: 00000">
                        </div>
                    </div>
                    <div id="alert-resultado" style="display: none;"></div>
                    <button type="submit" class="btn btn-primary btn-submit-integracao">
                        <i class="fas fa-check"></i> Enviar Integração
                    </button>
                </form>
            </div>
        `,
        armazenamento: `
            <div class="form-section">
                <h5 class="mb-4"><i class="fas fa-warehouse"></i> Formulário de Integração de Armazenamento</h5>
                <form id="form-integracao-armazenamento">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="armazenamento-item" class="form-label">Item</label>
                            <input type="text" class="form-control" id="armazenamento-item" placeholder="Ex: ITEM-001">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="armazenamento-quantidade" class="form-label">Quantidade</label>
                            <input type="number" class="form-control" id="armazenamento-quantidade" placeholder="0" min="0">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="armazenamento-zona" class="form-label">Zona</label>
                            <input type="text" class="form-control" id="armazenamento-zona" placeholder="Ex: A-001-01">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-submit-integracao">
                        <i class="fas fa-check"></i> Enviar Integração
                    </button>
                </form>
            </div>
        `,
        picking: `
            <div class="form-section">
                <h5 class="mb-4"><i class="fas fa-hand-paper"></i> Formulário de Integração de Picking</h5>
                <form id="form-integracao-picking">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="picking-item" class="form-label">Item</label>
                            <input type="text" class="form-control" id="picking-item" placeholder="Ex: ITEM-001">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="picking-quantidade" class="form-label">Quantidade</label>
                            <input type="number" class="form-control" id="picking-quantidade" placeholder="0" min="0">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="picking-zona" class="form-label">Zona</label>
                            <input type="text" class="form-control" id="picking-zona" placeholder="Ex: A-001-01">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-warning btn-submit-integracao">
                        <i class="fas fa-check"></i> Enviar Integração
                    </button>
                </form>
            </div>
        `,
        inventario: `
            <div class="form-section">
                <h5 class="mb-4"><i class="fas fa-clipboard-list"></i> Inventário</h5>
                <div class="mb-3">
                    <button type="button" class="btn btn-primary" id="btn-atualizar-inventario">
                        <i class="fas fa-sync-alt"></i> Atualizar
                    </button>
                    <button type="button" class="btn btn-success" id="btn-exportar-excel">
                        <i class="fas fa-file-excel"></i> Exportar em Excel
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Item</th>
                                <th>Quantidade</th>
                                <th>Zona</th>
                                <th>Data</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody id="tabela-inventario">
                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    <i class="fas fa-info-circle"></i> Nenhum dado disponível
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        `
    };

    content.innerHTML = formulas[tipo] || '<div class="alert alert-warning">Formulário não encontrado</div>';
    console.log('>>> Conteúdo do formulário inserido para tipo: ' + tipo);
    console.log('>>> HTML inserido:', content.innerHTML.substring(0, 100) + '...');

    // Adicionar evento ao formulário
    const form = content.querySelector('form');
    console.log('>>> Formulário encontrado?', !!form);
    if (form) {
        console.log('>>> Adicionando listener de submit ao formulário');
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            handleFormSubmit(tipo, this);
        });
    } else {
        console.warn('>>> AVISO: Formulário não foi encontrado após inserção do HTML');
    }
}

function handleFormSubmit(tipo, form) {
    // Coletar dados do formulário
    const formData = new FormData(form);
    const data = Object.fromEntries(formData);

    console.log('Tipo:', tipo);
    console.log('Dados:', data);

    // Mostrar alerta de carregamento
    const alertDiv = document.getElementById('alert-resultado');
    if (alertDiv) {
        alertDiv.innerHTML = '<div class="alert alert-info"><i class="fas fa-spinner fa-spin"></i> Processando...</div>';
        alertDiv.style.display = 'block';
    }

    // Chamar API baseado no tipo
    if (tipo === 'itens') {
        fetch('/api/xml-integration/insert', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if (!response.ok) {
                return response.text().then(text => {
                    throw new Error(`HTTP ${response.status}: ${text}`);
                });
            }
            return response.json();
        })
        .then(result => {
            if (result.success) {
                // Mostrar mensagem de sucesso
                const alertHtml = `
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <h5 class="alert-heading"><i class="fas fa-check-circle"></i> ${result.label}</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Sequence ID:</strong> ${result.details.sequence}<br>
                                <strong>SKU:</strong> ${result.summary.sku}<br>
                                <strong>Descrição:</strong> ${result.summary.description}
                            </div>
                            <div class="col-md-6">
                                <strong>Unidade:</strong> ${result.summary.base_qty_unit}<br>
                                <strong>Variante:</strong> ${result.summary.variant}<br>
                                <strong>Status:</strong> <span class="badge bg-warning">${result.summary.status}</span>
                            </div>
                        </div>
                        <hr>
                        <details class="mt-3">
                            <summary>Ver XML Gerado</summary>
                            <pre class="mt-2"><code>${escapeHtml(result.details.data)}</code></pre>
                        </details>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;
                alertDiv.innerHTML = alertHtml;
                alertDiv.style.display = 'block';
                
                // Limpar formulário
                form.reset();
                
                // Auto-fechar após 10 segundos
                setTimeout(() => {
                    alertDiv.style.display = 'none';
                }, 10000);
            } else {
                alertDiv.innerHTML = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h5><i class="fas fa-times-circle"></i> ${result.label}</h5>
                    ${result.message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`;
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            alertDiv.innerHTML = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h5><i class="fas fa-exclamation-triangle"></i> Erro na requisição</h5>
                <p><strong>Detalhes:</strong> ${escapeHtml(error.message)}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>`;
        });
    } else {
        alert('Formulário de ' + tipo + ' ainda não implementado!');
    }
}

function escapeHtml(text) {
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return text.replace(/[&<>"']/g, m => map[m]);
}

// Função para exportar tabela para Excel
document.addEventListener('click', function(e) {
    if (e.target && e.target.id === 'btn-exportar-excel') {
        exportarTableparaExcel('tabela-inventario', 'inventario.xlsx');
    }
    if (e.target && e.target.id === 'btn-atualizar-inventario') {
        atualizarInventario();
    }
});

function atualizarInventario() {
    const btn = document.getElementById('btn-atualizar-inventario');
    const originalText = btn.innerHTML;
    
    // Mostrar carregamento
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Atualizando...';
    btn.disabled = true;

    // Aqui você chamará a API para atualizar
    // Exemplo:
    // fetch('/api/integracao/inventario', {
    //     method: 'GET',
    //     headers: {
    //         'X-CSRF-TOKEN': '{{ csrf_token() }}'
    //     }
    // })
    // .then(response => response.json())
    // .then(data => {
    //     console.log('Dados atualizados:', data);
    //     // Popular a tabela com os dados
    //     populartabelaInventario(data);
    // })
    // .catch(error => {
    //     console.error('Erro:', error);
    //     alert('Erro ao atualizar inventário');
    // })
    // .finally(() => {
    //     btn.innerHTML = originalText;
    //     btn.disabled = false;
    // });

    // Simulação
    setTimeout(() => {
        console.log('Inventário atualizado');
        btn.innerHTML = originalText;
        btn.disabled = false;
        alert('Inventário atualizado com sucesso!');
    }, 1000);
}

function exportarTableparaExcel(tableId, fileName) {
    const table = document.getElementById(tableId);
    const ws = XLSX.utils.table_to_sheet(table);
    const wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, 'Inventário');
    XLSX.writeFile(wb, fileName);
}
</script>

<!-- Biblioteca XLSX para exportar Excel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.min.js"></script>

@endsection

