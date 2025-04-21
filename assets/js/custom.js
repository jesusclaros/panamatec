document.addEventListener('DOMContentLoaded', () => {
  const listaCarrito = document.getElementById('lista-carrito');
  const contadorCarrito = document.getElementById('contador-carrito');
  const totalCarrito = document.getElementById('total-carrito');

  let carrito = [];

  document.querySelectorAll('.agregar-carrito').forEach(boton => {
    boton.addEventListener('click', () => {
      const nombre = boton.getAttribute('data-nombre');
      const precio = parseFloat(boton.getAttribute('data-precio'));

      const index = carrito.findIndex(p => p.nombre === nombre);
      if (index !== -1) {
        carrito[index].cantidad++;
      } else {
        carrito.push({ nombre, precio, cantidad: 1 });
      }

      actualizarCarrito();
    });
  });

  function actualizarCarrito() {
    listaCarrito.innerHTML = '';
    let total = 0;
    let totalProductos = 0;

    carrito.forEach((producto, index) => {
      total += producto.precio * producto.cantidad;
      totalProductos += producto.cantidad;

      const item = document.createElement('li');
      item.className = 'list-group-item d-flex justify-content-between align-items-center';
      item.innerHTML = `
        <div class="d-flex flex-column">
          <strong>${producto.nombre}</strong>
          <small>$${producto.precio.toFixed(2)} c/u</small>
        </div>
        <div class="d-flex align-items-center gap-2">
          <button class="btn btn-sm btn-outline-secondary" onclick="cambiarCantidad(${index}, -1)">−</button>
          <span>${producto.cantidad}</span>
          <button class="btn btn-sm btn-outline-secondary" onclick="cambiarCantidad(${index}, 1)">+</button>
          <button class="btn btn-sm btn-danger" onclick="eliminarProducto(${index})">Eliminar</button>
        </div>
      `;
      listaCarrito.appendChild(item);
    });

    contadorCarrito.textContent = totalProductos;
    totalCarrito.textContent = total.toFixed(2);
  }

  window.cambiarCantidad = function(index, cambio) {
    carrito[index].cantidad += cambio;
    if (carrito[index].cantidad <= 0) {
      carrito.splice(index, 1);
    }
    actualizarCarrito();
  }

  window.eliminarProducto = function(index) {
    carrito.splice(index, 1);
    actualizarCarrito();
  }
});
