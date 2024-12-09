<!-- resources/views/receitas/edit.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Receita</title>
    <!-- Add your stylesheets and scripts here -->
</head>
<body>
<div class="container">
    <h1>Edit Receita</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('receitas.update', $receita->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="data">Date</label>
            <input type="date" id="data" name="data" class="form-control" value="{{ $receita->data }}" required>
        </div>
        <div class="form-group">
            <label for="nome_paciente">Patient Name</label>
            <input type="text" id="nome_paciente" name="nome_paciente" class="form-control" value="{{ $receita->nome_paciente }}" required>
        </div>
        <div class="form-group">
            <label for="codigo_profissional">Professional</label>
            <select id="codigo_profissional" name="codigo_profissional" class="form-control" required>
                @foreach ($profissionais as $profissional)
                    <option value="{{ $profissional->codigo }}" {{ $profissional->codigo == $receita->codigo_profissional ? 'selected' : '' }}>{{ $profissional->nome }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="tipo_receita">Tipo Receita</label>
            <select id="tipo_receita" name="tipo_receita" class="form-control" required>
                <option value="Normal" {{ $receita->tipo_receita == 'Normal' ? 'selected' : '' }}>Normal</option>
                <option value="Controle Especial" {{ $receita->tipo_receita == 'Controle Especial' ? 'selected' : '' }}>Controle Especial</option>
            </select>
        </div>
        <div class="form-group">
            <label for="medicamentos">Medicamentos</label>
            <div id="medicamentos">
                @foreach ($receita->medicamentos as $index => $medicamento)
                    <div class="medicamento">
                        <input type="hidden" name="medicamentos[{{ $index }}][id]" value="{{ $medicamento->id }}">
                        <input type="text" name="medicamentos[{{ $index }}][medicamento]" placeholder="Medicamento" class="form-control" value="{{ $medicamento->medicamento }}" required>
                        <input type="text" name="medicamentos[{{ $index }}][quantidade]" placeholder="Quantidade" class="form-control" value="{{ $medicamento->quantidade }}" required>
                        <textarea name="medicamentos[{{ $index }}][modo_usar]" placeholder="Modo de Usar" class="form-control" required>{{ $medicamento->modo_usar }}</textarea>
                    </div>
                @endforeach
            </div>
            <button type="button" id="add-medicamento" class="btn btn-secondary">Add Medicamento</button>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>

<!-- Add your scripts here -->
<script>
    document.getElementById('add-medicamento').addEventListener('click', function() {
        var medicamentos = document.getElementById('medicamentos');
        var index = medicamentos.children.length;
        var newMedicamento = document.createElement('div');
        newMedicamento.className = 'medicamento';
        newMedicamento.innerHTML = `
            <input type="hidden" name="medicamentos[${index}][id]" value="">
            <input type="text" name="medicamentos[${index}][medicamento]" placeholder="Medicamento" class="form-control" required>
            <input type="text" name="medicamentos[${index}][quantidade]" placeholder="Quantidade" class="form-control" required>
            <textarea name="medicamentos[${index}][modo_usar]" placeholder="Modo de Usar" class="form-control" required></textarea>
        `;
        medicamentos.appendChild(newMedicamento);
    });
</script>
</body>
</html>
