<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Techmarket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    @vite('resources/css/style.css')
</head>
<body>
    @include('components.header', 
    [
        'greeting' => 'Techmarket - Home', 
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
            <h1>Bem-vindos ao site Techmarket</h1>
            <p>Somos uma empresa  aonde trabalhamos com transações com maior <span style="text-transform: uppercase"><strong>segurança</strong></span> e <span style="text-transform: uppercase"><strong>simplicidade</strong></span>!</p>
            <p>Caso não tenha uma conta para realizar transações, cadastre-se aqui abaixo preenchendo o formulário</p>
        </div>
        <div class="form">
            @include('components.form', [
                'name' => 'Nome Completo',
                'cpf' => 'CPF',
                'phone' => 'Telefone',
                'birthdate' => 'Data de Nascimento',
                'amount' => 'Valor Inicial'
            ])
        </div>
        
    </main>

    @include('components.footer', [
        'copyright' => 'Techmarket ' . date('Y') . '. Todos os direitos reservados.'
    ]) 
    
    @vite('resources/js/createUser.js')

</body>
</html>