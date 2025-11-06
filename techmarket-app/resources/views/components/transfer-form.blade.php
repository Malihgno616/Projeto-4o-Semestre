<form action="#">
    @method('POST')
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">{{ $fromCpf }}</label>
        <input type="text" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">{{ $toCpf }}</label>
        <input type="text" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">{{ $amount }}</label>
        <input type="number" class="form-control" id="exampleInputPassword1">
    </div>
    
    <button type="submit" class="btn btn-success d-flex justify-content-center fs-5">Transferir</button>
</form>