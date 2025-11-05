<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transações</title>
    @vite('resources/css/style.css')
</head>
<body>
    
    <header class="header">
        <h1>Bem-vindos ao Techmarket</h1>
        <p>Aqui exibimos as transações em destaque</p>
    </header>
    
    <main class="main">
        <section id="transactions-js" class="transactions"></section>
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Techmarket. Todos os direitos reservados.</p>
    </footer>

    @vite('resources/js/transactions.js')

</body>
</html>