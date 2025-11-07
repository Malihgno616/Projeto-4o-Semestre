<form id="transferForm">
    <div id="message"></div>
    <div class="mb-3">
        <label for="from-cpf" class="form-label">{{ $fromCpf }}</label>
        <input type="text" class="form-control" id="from-cpf">
    </div>
    <div class="mb-3">
        <label for="to-cpf" class="form-label">{{ $toCpf }}</label>
        <input type="text" class="form-control" id="to-cpf">
    </div>
    <div class="mb-3">
        <label for="amount" class="form-label">{{ $amount }}</label>
        <input type="number" class="form-control" id="amount">
    </div>
    <button type="submit" class="btn btn-success d-flex justify-content-center fs-5">Transferir</button>
</form>