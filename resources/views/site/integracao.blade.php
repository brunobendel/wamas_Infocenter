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
document.querySelectorAll('.integration-radio').forEach(radio => {
    radio.addEventListener('change', function() {
        if (this.checked) {
            updateIntegrationForm(this.value);
        }
    });
});

function updateIntegrationForm(tipo) {
    const content = document.getElementById('integracao-content');

    const formulas = {
        itens: `
            <div class="form-section">
                <h5 class="mb-4"><i class="fas fa-box"></i> Formulário de Integração de Itens</h5>
                <form id="form-integracao-itens">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="itens-sku" class="form-label">SKU/Código do Item</label>
                            <input type="text" class="form-control" id="itens-sku" placeholder="Ex: ITEM-001">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="itens-descricao" class="form-label">Descrição</label>
                            <input type="text" class="form-control" id="itens-descricao" placeholder="Descrição do item">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="itens-unidade" class="form-label">Unidade de Medida</label>
                            <select class="form-select" id="itens-unidade">
                                <option selected>Selecione...</option>
                                <option value="un">Unidade</option>
                                <option value="kg">Quilograma</option>
                                <option value="l">Litro</option>
                                <option value="m">Metro</option>
                            </select>
                        </div>
                    </div>
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

    // Adicionar evento ao formulário
    const form = content.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            handleFormSubmit(tipo, this);
        });
    }
}

function handleFormSubmit(tipo, form) {
    // Coletar dados do formulário
    const formData = new FormData(form);
    const data = Object.fromEntries(formData);

    console.log('Tipo:', tipo);
    console.log('Dados:', data);

    // Aqui você chamará a API
    // Exemplo:
    // fetch('/api/integracao/' + tipo, {
    //     method: 'POST',
    //     headers: {
    //         'Content-Type': 'application/json',
    //         'X-CSRF-TOKEN': '{{ csrf_token() }}'
    //     },
    //     body: JSON.stringify(data)
    // })

    alert('Formulário de ' + tipo + ' pronto para enviar à API!\nVerifique o console para os dados.');
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

