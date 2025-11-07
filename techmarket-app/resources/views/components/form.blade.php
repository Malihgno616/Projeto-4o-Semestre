<div id="alert-register"></div>
<form id="apiCreateUser">
    <div class="mb-3">
        <label for="name" class="form-label">{{ $name }}</label>
        <input type="text" class="form-control" id="name" required>
    </div>
    <div class="mb-3">
        <label for="cpf" class="form-label">{{ $cpf }}</label>
        <input type="text" class="form-control" id="cpf" required>
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">{{ $phone }}</label>
        <input type="text" class="form-control" id="phone" required>
    </div>
    <div class="mb-3">
        <label for="birthdate" class="form-label">{{ $birthdate }}</label>
        <input type="text" class="form-control" id="birthdate" placeholder="DD/MM/AAAA" required>
        <div class="form-text">Formato: DD/MM/AAAA</div>
    </div>
    <div class="mb-3">
        <label for="amount" class="form-label">{{ $amount }}</label>
        <input type="number" class="form-control" id="amount" step="0.01" min="0" required>
    </div>
    <button type="submit" class="btn btn-success d-flex justify-content-center fs-5">Cadastrar</button>
</form>