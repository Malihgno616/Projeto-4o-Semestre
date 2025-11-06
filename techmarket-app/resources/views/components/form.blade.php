<form action="#">
    @method('POST')
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">{{ $name }}</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">{{ $cpf }}</label>
        <input type="text" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">{{ $phone }}</label>
        <input type="text" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">{{ $birthdate }}</label>
        <input type="text" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">{{ $amount }}</label>
        <input type="number" class="form-control" id="exampleInputPassword1">
    </div>
    <button type="submit" class="btn btn-success d-flex justify-content-center fs-5">Cadastrar</button>
</form>