// Configuração das máscaras
const masks = {
    cpf: new Inputmask("999.999.999-99", { placeholder: "_", clearIncomplete: true }),
    date: new Inputmask("99/99/9999", { placeholder: "_", clearIncomplete: true }),
    phone: new Inputmask("(99) 99999-9999", { placeholder: "_", clearIncomplete: true }),
};

// Função para aplicar a máscara no foco
function applyMaskOnFocus(input, mask) {
    input.addEventListener("focus", () => {
        mask.mask(input); // Aplica a máscara no campo
    });
}

// Aplica as máscaras nos campos ao carregar o DOM
document.addEventListener("DOMContentLoaded", () => {
    applyMaskOnFocus(document.getElementById("cpf"), masks.cpf);
    applyMaskOnFocus(document.getElementById("data_nasc"), masks.date);
    applyMaskOnFocus(document.getElementById("contato"), masks.phone);
});

