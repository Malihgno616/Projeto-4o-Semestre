fetch("/api/transactions")
    .then((response) => response.json())
    .then((transactions) => {
        const container = document.getElementById("transactions-js");
        container.innerHTML = transactions
            .map(
                (t) => `
            <div class="transaction-card">
                <p><strong>Valor: </strong>R$ ${t.amount
                    .toFixed(2)
                    .replace(".", ",")}</p>
                <p><strong>Data: </strong> ${new Date(
                    t.created_at
                ).toLocaleDateString("pt-BR")}</p>
            </div>
        `
            )
            .join("");
    });
