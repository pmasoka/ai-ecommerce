/*
|------------------------------------------------------------
| Update Cart Quantity
|------------------------------------------------------------
*/

$(document).on(
    'change',
    '.cartQty',
    function () {
        let qtyInput = $(this);

        $.ajax({
            url: '/cart/update',
            type: 'POST',
            data: {
                _token:
                    $('meta[name="csrf-token"]')
                        .attr('content'),
                quantity:
                    qtyInput.val(),
                cart_item_id:
                    qtyInput.data('id'),
                key:
                    qtyInput.data('key')
            },
            success: function (response) {
                /*
                |------------------------------------------------------------
                | Update Cart Counts
                |------------------------------------------------------------
                */
                $('#headerCartCount')
                    .text(response.cart_count);

                $('#cartPageCount')
                    .text(response.cart_count);

                /*
                |------------------------------------------------------------
                | Update Grand Total
                |------------------------------------------------------------
                */
                $('#grandTotal')
                    .text(response.cart_total);

                /*
                |------------------------------------------------------------
                | Current Row
                |------------------------------------------------------------
                */
                let row =
                    qtyInput.closest('tr');

                /*
                |------------------------------------------------------------
                | Unit Price
                |------------------------------------------------------------
                */
                let unitPrice = parseFloat(
                    row.find('td:eq(3)')
                        .text()
                        .replace(/[^0-9.]/g, '')
                );

                /*
                |------------------------------------------------------------
                | Calculate Sub Total
                |------------------------------------------------------------
                */
                let subTotal =
                    unitPrice *
                    response.quantity;

                /*
                |------------------------------------------------------------
                | Update Sub Total
                |------------------------------------------------------------
                */
                row.find('.subTotal')
                    .html(
                        '$. ' +
                        subTotal.toLocaleString(
                            'en-IN',
                            {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }
                        )
                    );
            }
        });
    });

/*
|------------------------------------------------------------
| Remove Cart Item
|------------------------------------------------------------
*/

$(document).on(
    'click',
    '.removeCartItem',
    function () {
        /*
        |------------------------------------------------------------
        | Confirmation Alert
        |------------------------------------------------------------
        */
        if (
            !confirm(
                'Are you sure you want to remove this item from cart?'
            )
        ) {
            return false;
        }

        let button = $(this);

        $.ajax({
            url: '/cart/delete',
            type: 'POST',
            data: {
                _token:
                    $('meta[name="csrf-token"]')
                        .attr('content'),
                cart_item_id:
                    button.data('id'),
                key:
                    button.data('key')
            },
            success: function (
                response
            ) {
                /*
                |------------------------------------------------------------
                | Remove Row
                |------------------------------------------------------------
                */
                button
                    .closest('tr')
                    .remove();

                /*
                |------------------------------------------------------------
                | Update Counts
                |------------------------------------------------------------
                */
                $('#headerCartCount')
                    .text(response.cart_count);

                $('#cartPageCount')
                    .text(response.cart_count);

                /*
                |------------------------------------------------------------
                | Update Grand Total
                |------------------------------------------------------------
                */
                $('#grandTotal')
                    .text(response.cart_total);

                /*
                |------------------------------------------------------------
                | Empty Cart Message
                |------------------------------------------------------------
                */
                if (
                    response.is_empty
                ) {
                    $('table.table')
                        .replaceWith(
                            '<div class="alert alert-info">' +
                            'Your cart is empty.' +
                            '</div>'
                        );
                }
            }
        });
    });