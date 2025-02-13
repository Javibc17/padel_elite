document.addEventListener("DOMContentLoaded", function() {
    
    "use strict";

    var KTSignupGeneral = function() {
        var e, // Form element
            t, // Submit button
            a, // Form validation instance
            s, // Password meter instance
            r = function() { // Function to check if password score is 100
                return 100 === s.getScore();
            };

        return {
            init: function() {
                // Select form and submit button
                e = document.querySelector("#kt_sign_up_form");
                t = document.querySelector("#kt_sign_up_submit");

                // Initialize password meter
                s = KTPasswordMeter.getInstance(e.querySelector('[data-kt-password-meter="true"]'));

                // Initialize form validation
                a = FormValidation.formValidation(e, {
                    fields: {
                        "nombre": {
                            validators: {
                                notEmpty: { message: "El Nombre es Obligatorio" }
                            }
                        },
                        "telefono": {
                            validators: {
                                notEmpty: { message: "El Teléfono es Obligatorio" }
                            }
                        },
                        "email": {
                            validators: {
                                notEmpty: { message: "El Email es Obligatorio" },
                                emailAddress: { message: "Email no válido" }
                            }
                        },
                        "contraseña": {
                            validators: {
                                notEmpty: { message: "La Contraseña es Obligatoria" },
                                callback: {
                                    message: "Porfavor pon una contraseña correcta",
                                    callback: function(e) {
                                        if (e.value.length > 0) return r();
                                    }
                                }
                            }
                        },
                        "confirm-password": {
                            validators: {
                                notEmpty: { message: "La confirmacion de Contraseña es Obligatoria" },
                                identical: {
                                    compare: function() {
                                        return e.querySelector('[name="contraseña"]').value;
                                    },
                                    message: "Las contraseñas no coinciden"
                                }
                            }
                        },
                        toc: {
                            validators: {
                                notEmpty: { message: "Debes aceptar los Términos y Condiciones" }
                            }
                        }
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger({ event: { password: false } }),
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: ".fv-row",
                            eleInvalidClass: "",
                            eleValidClass: ""
                        })
                    }
                });

                // Submit button click event
                t.addEventListener("click", function(r) {
                    r.preventDefault();
                    console.log("Submit button clicked");
                    a.revalidateField("contraseña");
                    a.validate().then(function(a) {
                        console.log("Validation result:", a);
                        if ("Valid" == a) {
                            t.setAttribute("data-kt-indicator", "on");
                            t.disabled = true;

                            // Send form data via AJAX
                            var formData = new FormData(e);
                            console.log("Form data prepared", formData);
                            fetch(e.action, {
                                method: 'POST',
                                body: formData
                            }).then(response => response.json())
                            .then(data => {
                                console.log("Response received", data);
                                t.removeAttribute("data-kt-indicator");
                                t.disabled = false;

                                if (data.success) {
                                    // Show success message
                                    Swal.fire({
                                        text: "Cuenta creada exitosamente!",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: { confirmButton: "btn btn-primary" }
                                    }).then(function(t) {
                                        if (t.isConfirmed) {
                                            e.reset();
                                            s.reset();
                                            window.location.href = "<?= base_url('signIn') ?>";
                                        }
                                    });
                                } else {
                                    // Show error message
                                    Swal.fire({
                                        text: "Hubo un problema al crear la cuenta.",
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "Reintentar",
                                        customClass: { confirmButton: "btn btn-primary" }
                                    });
                                }
                            }).catch(error => {
                                console.error("Error during fetch", error);
                                t.removeAttribute("data-kt-indicator");
                                t.disabled = false;
                                // Show error message
                                Swal.fire({
                                    text: "Hubo un problema al crear la cuenta.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Reintentar",
                                    customClass: { confirmButton: "btn btn-primary" }
                                });
                            });
                        } else {
                            // Show error message
                            Swal.fire({
                                text: "Parece que hay algunos errores, porfavor intentelo de nuevo.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Reintentar",
                                customClass: { confirmButton: "btn btn-primary" }
                            });
                        }
                    }).catch(error => {
                        console.error("Validation error", error);
                    });
                });

                // Password input event
                e.querySelector('input[name="contraseña"]').addEventListener("input", function() {
                    if (this.value.length > 0) {
                        a.updateFieldStatus("contraseña", "NotValidated");
                    }
                });
            }
        };
    }();

    // Initialize on DOM content loaded
    KTUtil.onDOMContentLoaded(function() {
        KTSignupGeneral.init();
    });
});

