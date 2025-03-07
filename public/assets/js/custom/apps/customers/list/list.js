"use strict";

var KTCustomersList = function() {
    var n;

    // Función para manejar la eliminación de filas individuales
    const c = () => {
        const deleteButtons = n.querySelectorAll('[data-kt-customer-table-filter="delete_row"]');
        if (deleteButtons.length > 0) {
            deleteButtons.forEach((e) => {
                e.addEventListener("click", (function(e) {
                    e.preventDefault();
                    const o = e.target.closest("tr"),
                          n = o.querySelectorAll("td")[1].innerText;

                    Swal.fire({
                        text: "Are you sure you want to delete " + n + "?",
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "Yes, delete!",
                        cancelButtonText: "No, cancel",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        }
                    }).then((function(e) {
                        if (e.value) {
                            Swal.fire({
                                text: "You have deleted " + n + "!",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary"
                                }
                            }).then((function() {
                                o.remove();
                            }));
                        } else if ("cancel" === e.dismiss) {
                            Swal.fire({
                                text: n + " was not deleted.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary"
                                }
                            });
                        }
                    }));
                }));
            });
        }
    };

    // Función para manejar la eliminación de filas seleccionadas
    const r = () => {
        const checkboxes = n.querySelectorAll('[type="checkbox"]'),
              deleteSelectedButton = document.querySelector('[data-kt-customer-table-select="delete_selected"]');

        if (checkboxes.length > 0) {
            checkboxes.forEach((t) => {
                t.addEventListener("click", (function() {
                    setTimeout((function() {
                        l();
                    }), 50);
                }));
            });
        }

        if (deleteSelectedButton) {
            deleteSelectedButton.addEventListener("click", (function() {
                Swal.fire({
                    text: "Are you sure you want to delete selected customers?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then((function(o) {
                    if (o.value) {
                        Swal.fire({
                            text: "You have deleted all selected customers!",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary"
                            }
                        }).then((function() {
                            checkboxes.forEach((e) => {
                                if (e.checked) {
                                    e.closest("tbody tr").remove();
                                }
                            });
                            n.querySelectorAll('[type="checkbox"]')[0].checked = false;
                        }));
                    } else if ("cancel" === o.dismiss) {
                        Swal.fire({
                            text: "Selected customers were not deleted.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary"
                            }
                        });
                    }
                }));
            }));
        }
    };

    // Función para actualizar la interfaz de usuario según la selección
    const l = () => {
        const baseToolbar = document.querySelector('[data-kt-customer-table-toolbar="base"]'),
              selectedToolbar = document.querySelector('[data-kt-customer-table-toolbar="selected"]'),
              selectedCount = document.querySelector('[data-kt-customer-table-select="selected_count"]'),
              checkboxes = n.querySelectorAll('tbody [type="checkbox"]');

        let r = false, l = 0;

        checkboxes.forEach((t) => {
            if (t.checked) {
                r = true;
                l++;
            }
        });

        if (r) {
            selectedCount.innerHTML = l;
            baseToolbar.classList.add("d-none");
            selectedToolbar.classList.remove("d-none");
        } else {
            baseToolbar.classList.remove("d-none");
            selectedToolbar.classList.add("d-none");
        }
    };

    return {
        init: function() {
            n = document.querySelector("#kt_customers_table");
            if (n) {
                n.querySelectorAll("tbody tr").forEach((t) => {
                    const e = t.querySelectorAll("td");
                    if (e[5]) {
                        const o = moment(e[5].innerHTML, "DD MMM YYYY, LT").format();
                        e[5].setAttribute("data-order", o);
                    }
                });

                r();
                const searchInput = document.querySelector('[data-kt-customer-table-filter="search"]');
                if (searchInput) {
                    searchInput.addEventListener("keyup", function(e) {
                        const searchValue = e.target.value.toLowerCase();
                        n.querySelectorAll("tbody tr").forEach((row) => {
                            const cells = row.querySelectorAll("td");
                            let match = false;
                            cells.forEach((cell) => {
                                if (cell.innerText.toLowerCase().includes(searchValue)) {
                                    match = true;
                                }
                            });
                            if (match) {
                                row.style.display = "";
                            } else {
                                row.style.display = "none";
                            }
                        });
                    });
                }

                const monthFilter = $('[data-kt-customer-table-filter="month"]');
                const paymentTypeFilters = document.querySelectorAll('[data-kt-customer-table-filter="payment_type"] [name="payment_type"]');

                const filterButton = document.querySelector('[data-kt-customer-table-filter="filter"]');
                if (filterButton) {
                    filterButton.addEventListener("click", function() {
                        const monthValue = monthFilter.val();
                        let paymentTypeValue = "";
                        paymentTypeFilters.forEach((t) => {
                            if (t.checked) {
                                paymentTypeValue = t.value;
                            }
                            if (paymentTypeValue === "all") {
                                paymentTypeValue = "";
                            }
                        });
                        const filterValue = monthValue + " " + paymentTypeValue;
                        n.querySelectorAll("tbody tr").forEach((row) => {
                            const cells = row.querySelectorAll("td");
                            let match = false;
                            cells.forEach((cell) => {
                                if (cell.innerText.toLowerCase().includes(filterValue.toLowerCase())) {
                                    match = true;
                                }
                            });
                            if (match) {
                                row.style.display = "";
                            } else {
                                row.style.display = "none";
                            }
                        });
                    });
                }

                const resetButton = document.querySelector('[data-kt-customer-table-filter="reset"]');
                if (resetButton) {
                    resetButton.addEventListener("click", function() {
                        monthFilter.val(null).trigger("change");
                        paymentTypeFilters[0].checked = true;
                        n.querySelectorAll("tbody tr").forEach((row) => {
                            row.style.display = "";
                        });
                    });
                }

                c();
            }
        }
    };
}();

KTUtil.onDOMContentLoaded(function() {
    KTCustomersList.init();
});

document.addEventListener('DOMContentLoaded', function() {
    // Asegúrate de que los elementos existen antes de manipularlos
    const elements = document.querySelectorAll('.some-class');
    if (elements.length > 0) {
        elements.forEach(element => {
            if (element) {
                element.innerHTML = 'Nuevo contenido';
            }
        });
    }
});