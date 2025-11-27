@extends('welcome')

@section('title', 'WAMAS LogiMat Infocenter')

@section('content')
<div class="container my-4">
    <h3 class="mb-4 fw-bold text-danger">WAMAS <span class="text-dark">LogiMat Infocenter 2.0</span></h3>

    <!-- Ferramentas -->
    <div class="mb-5">
        <h4 class="mb-3">Ferramentas</h4>
        <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-4">
            <div class="col">
                <div class="card card-tool text-center p-3 h-100">
                    <img src="/images/test.png" class="mx-auto" alt="TEST">
                    <p>Integração</p>
                </div>
            </div>
            <div class="col">
                <div class="card card-tool text-center p-3 h-100">
                    <img src="/images/P2L.png" class="mx-auto" alt="Grupo P2L">
                    <p>GRUPO P2L PRATELEIRA</p>
                </div>
            </div>
            <div class="col">
                <div class="card card-tool text-center p-3 h-100">
                    <img src="/images/compartimentos.png" class="mx-auto" alt="Compartimentos">
                    <p>COMPARTIMENTOS</p>
                </div>
            </div>
            <div class="col">
                <div class="card card-tool text-center p-3 h-100">
                    <img src="/images/unlock.png" class="mx-auto" alt="Desbloquear">
                    <p>DESBLOQUEAR COMPARTIMENTOS</p>
                </div>
            </div>
            <div class="col">
                <div class="card card-tool text-center p-3 h-100">
                    <img src="/images/cubatura.png" class="mx-auto" alt="Cubatura">
                    <p>CUBATURA ITEM P/ CAIXA</p>
                </div>
            </div>
            <div class="col">
                <div class="card card-tool text-center p-3 h-100">
                    <img src="/images/barcode.png" class="mx-auto" alt="Escaneie">
                    <p>ESCANEIE P/ PEGAR/GUARDAR</p>
                </div>
            </div>
            <div class="col">
                <div class="card card-tool text-center p-3 h-100">
                    <img src="/images/terminais.png" class="mx-auto" alt="Terminais">
                    <p>TERMINAIS</p>
                </div>
            </div>
            <div class="col">
                <div class="card card-tool text-center p-3 h-100">
                    <img src="/images/inventory.png" class="mx-auto" alt="Terminais">
                    <p>Gerenciamento de Estoque Mínimo</p>
                </div>
            </div>
            <div class="col">
                <div class="card card-tool text-center p-3 h-100">
                    <img src="/images/report.png" class="mx-auto" alt="Terminais">
                    <p>Estatísticas</p>
                </div>
            </div>
            <div class="col">
                <a href="{{ url('/importar-excel') }}" style="text-decoration: none; color: inherit;">
                    <div class="card card-tool text-center p-3 h-100">
                        <img src="/images/Importação de planilha.png" class="mx-auto" alt="Terminais">
                        <p>Importação de planilha</p>
                    </div>
                </a>
            </div>
            <div class="col">
                <div class="card card-tool text-center p-3 h-100">
                    <img src="/images/error.png" class="mx-auto" alt="Erros">
                    <p>ERROS DE INTERFACE</p>
                </div>
            </div>
            <div class="col">
                <div class="card card-tool text-center p-3 h-100">
                    <img src="/images/manuais.png" class="mx-auto" alt="Manuais">
                    <p>MANUAIS</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Relatórios Rápidos -->
    <div>
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
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@endsection