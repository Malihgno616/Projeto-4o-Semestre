document
    .getElementById("transferForm")
    .addEventListener("submit", async function (e) {
        e.preventDefault();

        const fromCpfInput = document.getElementById("from-cpf");
        const toCpfInput = document.getElementById("to-cpf");
        const amountInput = document.getElementById("amount");
        const messageDiv = document.getElementById("message"); // 🟢 Div para mensagens

        const fromCpf = fromCpfInput.value.trim();
        const toCpf = toCpfInput.value.trim();
        const amount = amountInput.value.trim();

        if (!fromCpf || !toCpf || !amount) {
            messageDiv.innerHTML = `
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Por favor, preencha todos os campos.</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      `;
            return;
        }

        if (isNaN(amount) || Number(amount) <= 0) {
            messageDiv.innerHTML = `
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Por favor, insira um valor válido para a quantia.</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      `;
            return;
        }

        if (fromCpf === toCpf) {
            messageDiv.innerHTML = `
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>A conta de origem e destino não podem ser iguais.</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      `;
            return;
        }

        const formData = {
            from_account_cpf: fromCpf,
            to_account_cpf: toCpf,
            amount: amount,
        };

        try {
            const response = await fetch("/api/transfer", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                },
                body: JSON.stringify(formData),
            });

            const data = await response.json();

            // 🟢 Exibe a mensagem no DOM
            messageDiv.innerHTML = `
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>${data.message}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;

            // Limpa os campos
            fromCpfInput.value = "";
            toCpfInput.value = "";
            amountInput.value = "";
        } catch (error) {
            console.error("Erro:", error);
            alert("Erro ao processar a transferência. Tente novamente.");
        }
    });
