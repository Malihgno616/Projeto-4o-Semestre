document
    .getElementById("apiCreateUser")
    .addEventListener("submit", async function (event) {
        event.preventDefault();
        
        const rawBirthdate = document.getElementById("birthdate").value.trim();
        const formattedBirthdate = formatDateToISO(rawBirthdate);

        const formData = {
            name: document.getElementById("name").value.trim(),
            cpf: document.getElementById("cpf").value.trim(),
            phone_number: document.getElementById("phone").value.trim(),
            date: formattedBirthdate,
            amount: parseFloat(document.getElementById("amount").value) || 0
        };

        if (!formData.name) {
            showAlert('❌ Preencha o nome.', 'error');
            return;
        }
        if (!formData.cpf) {
            showAlert('❌ Preencha o CPF.', 'error');
            return;
        }
        if (!rawBirthdate) {
            showAlert('❌ Preencha a data de nascimento.', 'error');
            return;
        }
        if (!formData.amount) {
            showAlert('❌ Preencha o valor.', 'error');
            return;
        }

        const validationResult = isValidDate(rawBirthdate);
        if (!validationResult.isValid) {
            showAlert(`❌ ${validationResult.error}`, 'error');
            document.getElementById("birthdate").focus();
            return;
        }

        const button = event.target.querySelector('button[type="submit"]');
        const originalText = button.textContent;
        button.textContent = 'Cadastrando...';
        button.disabled = true;

        try {
            const response = await fetch("/api/create-user", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                },
                body: JSON.stringify(formData),
            });

            const result = await response.json();

            if (response.ok) {
                showAlert('🎉 Usuário cadastrado com sucesso!', 'success');
                document.getElementById("apiCreateUser").reset();
            } else {
                let errorMessage = 'Erro ao cadastrar usuário';
                if (result.errors) {
                    const errorDetails = Object.entries(result.errors)
                        .map(([field, errors]) => `${errors[0]}`)
                        .join(', ');
                    errorMessage = errorDetails;
                } else if (result.message) {
                    errorMessage = result.message;
                }
                showAlert(`❌ ${errorMessage}`, 'error');
            }

        } catch (error) {
            showAlert(`💥 Erro: ${error.message}`, 'error');
        } finally {
            button.textContent = originalText;
            button.disabled = false;
        }
    });

document.getElementById("birthdate").addEventListener("input", function(e) {
    let value = e.target.value.replace(/\D/g, '');
    
    if (value.length > 8) {
        value = value.substring(0, 8);
    }
    
    if (value.length > 4) {
        value = value.replace(/(\d{2})(\d{2})(\d{0,4})/, '$1/$2/$3');
    } else if (value.length > 2) {
        value = value.replace(/(\d{2})(\d{0,2})/, '$1/$2');
    }
    
    e.target.value = value;
});

function formatDateToISO(dateString) {
    if (!dateString) return null;
    
    const parts = dateString.split('/');
    if (parts.length !== 3) return null;
    
    const day = parts[0];
    const month = parts[1];
    const year = parts[2];
    
    return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`;
}

function isValidDate(dateString) {
    if (!dateString) {
        return { isValid: false, error: 'Data de nascimento é obrigatória' };
    }

    if (!/^\d{2}\/\d{2}\/\d{4}$/.test(dateString)) {
        return { isValid: false, error: 'Use o formato DD/MM/AAAA' };
    }

    const parts = dateString.split('/');
    const day = parseInt(parts[0], 10);
    const month = parseInt(parts[1], 10);
    const year = parseInt(parts[2], 10);

    if (year < 1900 || year > new Date().getFullYear()) {
        return { isValid: false, error: 'Ano deve estar entre 1900 e ' + new Date().getFullYear() };
    }

    if (month < 1 || month > 12) {
        return { isValid: false, error: 'Mês deve estar entre 01 e 12' };
    }

    if (day < 1 || day > 31) {
        return { isValid: false, error: 'Dia deve estar entre 01 e 31' };
    }

    if ([4, 6, 9, 11].includes(month) && day > 30) {
        return { isValid: false, error: 'Este mês tem apenas 30 dias' };
    }

    if (month === 2) {
        const isLeapYear = (year % 4 === 0 && year % 100 !== 0) || (year % 400 === 0);
        if (isLeapYear && day > 29) {
            return { isValid: false, error: 'Fevereiro tem no máximo 29 dias em anos bissextos' };
        }
        if (!isLeapYear && day > 28) {
            return { isValid: false, error: 'Fevereiro tem no máximo 28 dias' };
        }
    }

    const date = new Date(year, month - 1, day);
    if (date.getDate() !== day || date.getMonth() !== month - 1 || date.getFullYear() !== year) {
        return { isValid: false, error: 'Data inválida' };
    }

    return { isValid: true, error: null };
}

function showAlert(message, type) {
    const alertDiv = document.getElementById("alert-register");
    const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
    const iconId = type === 'success' ? 'check-circle-fill' : 'exclamation-triangle-fill';
    
    alertDiv.innerHTML = `
        <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img">
                <use xlink:href="#${iconId}"/>
            </svg>
            <div>${message}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
}