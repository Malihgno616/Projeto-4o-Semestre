document.addEventListener("DOMContentLoaded", () => {
    fetch("/api/transactions")
        .then((response) => response.json())
        .then((transactions) => {
            const container = document.getElementById("transactions-js");

            container.innerHTML = transactions
                .map(
                    (t) => `
                <div class="card" style="width: 20rem;">
                    <div class="card-body">
                        <p><strong>Valor transferido</strong></p>
                        <p class="card-text">R$ ${Number(t.amount)
                            .toFixed(2)
                            .replace(".", ",")}</p>
                        <p><strong>Data: </strong> ${new Date(
                            t.created_at
                        ).toLocaleDateString("pt-BR")}</p>
                    </div>
                </div>
            `
                )
                .join("");
        });
});
