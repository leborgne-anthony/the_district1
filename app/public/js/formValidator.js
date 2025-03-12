class FormValidator {
    constructor(formSelector) {
        this.form = document.querySelector(formSelector);
        this.fields = this.form.querySelectorAll("input, textarea");
        this.errors = {};

        this.init();
    }

    init() {
        this.form.addEventListener("submit", (event) => this.handleSubmit(event));
    }

    handleSubmit(event) {
        this.clearErrors();
        let isValid = true;

        this.fields.forEach((field) => {
            const fieldName = field.name;
            const value = field.value.trim();

            if (!this.validateField(field, value)) {
                isValid = false;
            }
        });

        if (!isValid) {
            event.preventDefault();
        }
    }

    validateField(field, value) {
        const name = field.name;
        let isValid = true;

        if (value === "") {
            this.showError(field, "Ce champ est requis.");
            isValid = false;
        } else if (name === "email" && !this.isValidEmail(value)) {
            this.showError(field, "L'email n'est pas valide.");
            isValid = false;
        } else if (name === "telephone" && !this.isValidPhone(value)) {
            this.showError(field, "Le numéro de téléphone est invalide.");
            isValid = false;
        }

        return isValid;
    }

    isValidEmail(email) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }

    isValidPhone(phone) {
        const regex = /^[0-9]{10}$/;
        return regex.test(phone);
    }

    showError(field, message) {
        const errorDiv = document.createElement("div");
        errorDiv.className = "error-message";
        errorDiv.innerText = message;
        field.classList.add("input-error");
        field.parentNode.appendChild(errorDiv);
    }

    clearErrors() {
        this.form.querySelectorAll(".error-message").forEach((el) => el.remove());
        this.form.querySelectorAll(".input-error").forEach((el) => el.classList.remove("input-error"));
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new FormValidator(".contact-form");
});
