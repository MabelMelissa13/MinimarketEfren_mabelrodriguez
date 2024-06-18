form.addEventListener("submit", function(event) {
    let valid = true;

    // Validar nombre del producto
    if (nombreInput.value.trim() === '') {
        nombreError.textContent = 'El nombre del producto es requerido.';
        nombreError.classList.remove("hidden");
        valid = false;
    } else {
        nombreError.classList.add("hidden");
    }

    // Validar precio por unidad
    const precio = parseFloat(precioInput.value.trim());
    if (isNaN(precio) || precio <= 0) {
        precioError.textContent = 'Ingrese un precio válido.';
        precioError.classList.remove("hidden");
        valid = false;
    } else {
        precioError.classList.add("hidden");
    }

    // Validar cantidad del inventario
    const cantidad = parseInt(cantidadInput.value.trim());
    if (isNaN(cantidad) || cantidad < 0) {
        cantidadError.textContent = 'Ingrese una cantidad válida.';
        cantidadError.classList.remove("hidden");
        valid = false;
    } else {
        cantidadError.classList.add("hidden");
    }

    if (!valid) {
        event.preventDefault();
    }
});

// Validación en tiempo real mientras el usuario escribe
nombreInput.addEventListener("input", function() {
    if (nombreInput.value.trim() === '') {
        nombreError.textContent = 'El nombre del producto es requerido.';
        nombreError.classList.remove("hidden");
    } else {
        nombreError.classList.add("hidden");
    }
});

precioInput.addEventListener("input", function() {
    const precio = parseFloat(precioInput.value.trim());
    if (isNaN(precio) || precio <= 0) {
        precioError.textContent = 'Ingrese un precio válido.';
        precioError.classList.remove("hidden");
    } else {
        precioError.classList.add("hidden");
    }
});

cantidadInput.addEventListener("input", function() {
    const cantidad = parseInt(cantidadInput.value.trim());
    if (isNaN(cantidad) || cantidad < 0) {
        cantidadError.textContent = 'Ingrese una cantidad válida.';
        cantidadError.classList.remove("hidden");
    } else {
        cantidadError.classList.add("hidden");
    }
});
