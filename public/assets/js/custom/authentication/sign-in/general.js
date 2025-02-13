"use strict";

var KTSigninGeneral = function() {
    var form, submitButton, validator;

    return {
        init: function() {
            // Selecciona el formulario y el botón de envío
            form = document.querySelector("#kt_sign_in_form");
            submitButton = document.querySelector("#kt_sign_in_submit");

            // Inicializa la validación del formulario
            validator = FormValidation.formValidation(form, {
                fields: {
                    email: {
                        validators: {
                            notEmpty: {
                                message: "La dirección de correo electrónico es obligatoria"
                            },
                            emailAddress: {
                                message: "El valor no es una dirección de correo electrónico válida"
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: "La contraseña es obligatoria"
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row"
                    })
                }
            });

            // Agrega un evento al botón de envío
            submitButton.addEventListener("click", function(event) {
                event.preventDefault(); // Previene el comportamiento por defecto del botón

                // Valida el formulario
                validator.validate().then(function(status) {
                    if (status === "Valid") {
                        // Si el formulario es válido
                        submitButton.setAttribute("data-kt-indicator", "on");
                        submitButton.disabled = true;

                        // Simula un retraso para la respuesta
                        setTimeout(function() {
                            submitButton.removeAttribute("data-kt-indicator");
                            submitButton.disabled = false;

                            // Muestra un mensaje de éxito
                            Swal.fire({
                                text: "¡Has iniciado sesión con éxito!",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "¡Ok!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            }).then(function(resultado) {
                                if (resultado.isConfirmed) {
                                    // Redirige al usuario al index
                                    window.location.href = "/padel_elite/public";
                                }
                            });
                        }, 2000);
                    } else {
                        // Si hay errores en el formulario
                        Swal.fire({
                            text: "Lo siento, parece que hay algunos errores detectados, por favor inténtalo de nuevo.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "¡Ok!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                });
            });
        }
    };
}();

// Inicializa el módulo cuando el contenido del DOM esté completamente cargado
KTUtil.onDOMContentLoaded(function() {
    KTSigninGeneral.init();
});