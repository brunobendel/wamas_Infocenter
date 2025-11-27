@extends('welcome')

@section('title', 'Importar Excel')

@section('content')
<a href="/">Voltar para a pagina inicial</a>
<div class="container" style="margin: 40px auto;">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h3 class="card-title mb-2 fw-bold">Importação de Planilha</h3>
            <h6 class="card-subtitle mb-4 text-muted" style="margin-top:-10px;">
                Itens / Armazenamento / Picking / Inventário / Cubatura
            </h6>
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="{{ route('import.excel') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="arquivo" class="form-label">Selecione o arquivo Excel</label>
                    <input type="file" class="form-control @error('arquivo') is-invalid @enderror" id="arquivo" name="arquivo" accept=".xlsx,.xls" required>
                    @error('arquivo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary w-100">Importar</button>
            </form>
            @if($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul class="mb-0">
                        @foreach($errors->all() as $erro)
                            <li>{{ $erro }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection