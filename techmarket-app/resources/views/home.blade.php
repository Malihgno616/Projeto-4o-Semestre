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
        <section class="transactions">
            @php
                use App\Models\Transaction;
                $transactions = Transaction::orderBy('amount', 'desc')->take(9)->get();
            @endphp

            @foreach ($transactions as $transaction)
                <div class="transaction-card">
                    <p><strong>Valor: </strong>R$ {{ number_format($transaction->amount, 2, ',', '.') }}</p>
                    <p><strong>Data: </strong> {{ date('d/m/Y', strtotime($transaction->created_at)) }}</p>
                </div>
            @endforeach
        </section>
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Techmarket. Todos os direitos reservados.</p>
    </footer>
</body>
</html>