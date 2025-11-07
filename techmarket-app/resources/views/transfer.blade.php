<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FastPay</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    @vite('resources/css/style.css')
</head>
<body>
    @include('components.header', 
    [
        'greeting' => 'Techmarket - Tranferência', 
        'title' => 'Gerencie suas transações de forma fácil e segura'
    ])

    <nav class="nav-bar">
        <ul class="nav-links">
            <li><a href="/">Home</a></li>
            <li><a href="/transactions">Transações em destaque</a></li>
            <li><a href="/transfer">Faça sua transação</a></li>
        </ul>
    </nav>

    <main class="main">
        <div>
            <h1>Realize a transferência</h1>
            <p>Preencha os dados corretamente</p>
        </div>
        <div class="form">
            @include('components.transfer-form', [
                'fromCpf' => 'CPF de Origem',
                'toCpf' => 'CPF de Destino',
                'amount' => 'Valor a ser Transferido'
            ])
        </div>
    </main>

    @include('components.footer', [
        'copyright' => 'Techmarket ' . date('Y') . '. Todos os direitos reservados.'
    ]) 
  
</body>
</html>