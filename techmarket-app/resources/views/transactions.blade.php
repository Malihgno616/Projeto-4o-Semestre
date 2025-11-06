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
        'greeting' => 'FastPay - Transações em destaque', 
        'title' => 'Gerencie suas transações de forma fácil e segura'
    ])

    <nav class="nav-bar">
        <ul class="nav-links">
            <li><a href="/">Home</a></li>
            <li><a href="/transactions">Transações em destaque</a></li>
            <li><a href="/transfer">Faça sua transação</a></li>
        </ul>
    </nav>
    
    <div>
        <h1>Transações em destaque</h1>
    </div>

    <div>
        <button onclick="location.reload()">Clique aqui para atualizar</button>
    </div>

    <main class="main">
        <section id="transactions-js" class="transactions"></section>
    </main>

    @include('components.footer', [
        'copyright' => 'Techmarket ' . date('Y') . '. Todos os direitos reservados.'
    ])
    
    @vite('resources/js/transactions.js')

</body>
</html>