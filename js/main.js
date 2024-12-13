const togglePaciente = document.getElementById('togglePaciente');
const conteudoPaciente = document.getElementById('conteudoPaciente');

togglePaciente.addEventListener('click', () => {
    if (conteudoPaciente.style.display === 'none' || conteudoPaciente.style.display === '') {
        conteudoPaciente.style.display = 'block';
    } else {
        conteudoPaciente.style.display = 'none';
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const toggleSections = document.querySelectorAll(".toggle-section");

    toggleSections.forEach(section => {
        section.addEventListener("click", function () {
            const content = this.nextElementSibling; 
            if (content.classList.contains("mostrar")) {
                content.classList.remove("mostrar");
            } else {
                content.classList.add("mostrar");
            }
        });
    });
});


//Máscara para o cpf
function aplicarMascaraCPF(value) {
    let numeros = value.replace(/\D/g, '');

    if (numeros.length > 11) {
        numeros = numeros.slice(0, 11);
    }

    numeros = numeros.replace(/(\d{3})(\d)/, '$1.$2');
    numeros = numeros.replace(/(\d{3})(\d)/, '$1.$2');
    numeros = numeros.replace(/(\d{3})(\d{1,2})$/, '$1-$2');

    return numeros;
}

document.addEventListener('DOMContentLoaded', (event) => {
    const cpfInput = document.getElementById('cpfPaciente');
    if (cpfInput) {
        cpfInput.value = aplicarMascaraCPF(cpfInput.value);

        if (!cpfInput.hasAttribute('readonly')) {
            cpfInput.addEventListener('input', (e) => {
                e.target.value = aplicarMascaraCPF(e.target.value);
            });
        }
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('nascPaciente');
            
    dateInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, "");
                
        if (value.length > 8) value = value.slice(0, 8);
                
        let formattedDate = value;
        if (value.length > 4) formattedDate = value.slice(0, 2) + "/" + value.slice(2, 4) + "/" + value.slice(4);
        else if (value.length > 2) formattedDate = value.slice(0, 2) + "/" + value.slice(2);
                
        e.target.value = formattedDate;
    });

        
    if (dateInput.value) {
        const currentValue = dateInput.value.replace(/\D/g, "");
        let initialFormattedDate = currentValue;
        if (currentValue.length > 4) initialFormattedDate = currentValue.slice(0, 2) + "/" + currentValue.slice(2, 4) + "/" + currentValue.slice(4);
        else if (currentValue.length > 2) initialFormattedDate = currentValue.slice(0, 2) + "/" + currentValue.slice(2);
                dateInput.value = initialFormattedDate;
    }
});


