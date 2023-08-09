<script type="text/javascript">
$(document).ready(function() {
    var productoSeleccionado = null;
    //Funcion para que cada vez que se seleccione un producto se consulte la informacion en el controlador
    $('#producto').change(function() {
        var productoId = $(this).val();
        var urlProducto = "{{ route('compras.getProducto', ['id_producto' => 'ID_PRODUCTO']) }}"
            .replace('ID_PRODUCTO', productoId);
        if (productoId) {
            $.ajax({
                url: urlProducto,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    productoSeleccionado = data;
                },
                error: function(error) {
                    swal("Error!","Hubo un error al obtener los detalles del producto.","error");
                }
            });
        }
    });
    // Función para agregar el producto seleccionado a la tabla cuando se presione el botón de "Añadir producto"
    $("#add_stock").click(function() {
                var stock = $("input[name='stock']").val();

                if (productoSeleccionado && stock && stock > 0) {
                    var productoExistente = $(`#producto_${productoSeleccionado.id}`);

                    if (productoExistente.length) {
                        // Si el producto ya está en la tabla, suma el stock al stock añadido
                        var stockAnadidoActual = parseInt(productoExistente.find(".stock-nuevo").text());
                        var nuevoStockAnadido = stockAnadidoActual + parseInt(stock);

                        productoExistente.find(".stock-nuevo").text(nuevoStockAnadido);
                        // Calcula el nuevo costo total
                        var nuevoCostoTotal = nuevoStockAnadido * productoSeleccionado.precio_compra;

                        // Actualiza la celda del "costo total"
                        productoExistente.find(".costo-total").text(nuevoCostoTotal);
                        actualizarSumaTotalCosto();
                        // Actualiza el input oculto del stock
                        $(`input[name='stocks_${productoSeleccionado.id}']`).val(nuevoStockAnadido);
                    } else {
                        // Añadir fila a la tabla si el producto no existe en ella
                        var fila = `
                    <tr id="producto_${productoSeleccionado.id}">
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent.">
                            <div class="flex px-2 py-1">
                                <div>
                                    <img src="{{ asset('imagenProductos') }}/${productoSeleccionado.imagen}"  class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-in-out h-9 w-9 rounded-xl" alt="${productoSeleccionado.nombre}" />
                                </div>
                                <div class="flex flex-col justify-center">
                                    <h6 class="mb-0 text-sm leading-normal dark:text-white">${productoSeleccionado.nombre}</h6>
                                </div>
                            </div>
                        </td>
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">${productoSeleccionado.stock}</td>
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent stock-nuevo">${stock}</td>
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">${productoSeleccionado.precio_compra}</td>
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">${Math.round((productoSeleccionado.precio_compra*stock)*0.15)}</td>
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">${productoSeleccionado.precio_venta}</td>
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent costo-total">${productoSeleccionado.precio_compra*stock}</td>
                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent"">
                            <button type="button" class="btn-borrar">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                `;
                        $('#tablaProductos tbody').append(fila);
                        actualizarSumaTotalCosto();

                        // Generar inputs ocultos
                        var inputProducto =
                            `<input type="hidden" name="producto_ids[]" value="${productoSeleccionado.id}">`;
                        var inputStock = `<input type="hidden" name="stocks[]" value="${stock}">`;

                        $("form").append(inputProducto);
                        $("form").append(inputStock);
                    }

                    // Limpiar selección e input
                    $("#productos").val('');
                    $("input[name='stock']").val('');
                    productoSeleccionado = null;
                } else {
                    swal("Error!", "Por favor, selecciona un producto y añade un stock válido", "error");
                }
            });
            // Función para actualizar la suma total del costo
            function actualizarSumaTotalCosto() {
                var sumaTotal = 0;

                // Recorre todas las celdas de "costo total" y suma sus valores
                $(".costo-total").each(function() {
                    sumaTotal += parseFloat($(this).text());
                });

                // Actualiza la etiqueta <p> y el input con el valor calculado
                $("#sumaCostoTotal").text("$" + sumaTotal);
                $("#inputCostoTotal").val(sumaTotal);
            }
            // Función para eliminar un producto de la tabla y sus inputs correspondientes
            $(document).on('click', '.btn-borrar', function(e) {
                e.preventDefault();

                // Obtiene el ID del producto desde el atributo de la fila
                var productoId = $(this).closest('tr').attr('id').replace('producto_', '');

                // Elimina la fila de la tabla
                $(this).closest('tr').remove();

                // Elimina los inputs ocultos relacionados con este producto
                $(`input[name='producto_ids[]'][value='${productoId}']`).remove();
                $(`input[name='stocks_${productoId}']`).remove();

                // Actualiza la suma total del costo después de borrar el producto
                actualizarSumaTotalCosto();
            });
        });
});
</script>