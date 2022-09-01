<script>
    function openModal(input) {
        var parent = $(input).parents('.product-item');
        var imgsrc = $(parent.find('.product-img img')).attr('src');
        var name = $(parent.find('.card-body .text-truncate')).text();
        var price = $(parent.find('.card-body div .add-price')).text();
        var colors = $(parent.find('input[name="colors"]')).val();
        var sizes = $(parent.find('input[name="sizes"]')).val();
        var id = $(parent.find('input[name="id"]')).val();

        $('#add-img').attr('src', imgsrc);
        $('#add-id').val(id);
        $('#add-name').text(name);
        $('#add-price').text(price);
        $('#add-total').text(price);

        $('#add-color').empty();
        $.each(colors.split(','), function(key, value) {
            $('select[name="add-color"]').append('<option value=" ' + value + ' ">' + value + ' </option>')
        }) // end color

        $('select[name="add-size"]').empty();
        $.each(sizes.split(','), function(key, value) {
            $('select[name="add-size"]').append('<option value=" ' + value + ' ">' + value + ' </option>')
        }) // end size

    }
</script>

<script>
    function calculate() {
        setTimeout(
            function() {
                var text = $('#add-price').text();
                var priceVal = text.substring(1, text.length);
                $('#add-total').text('$' + $('#add-qty').val() * priceVal);
            }, 10);
    }
    $('#add-qty').change(function(e) {
        var text = $('#add-price').text();
        var priceVal = text.substring(1, text.length);
        $('#add-total').text('$' + $('#add-qty').val() * priceVal);
    });
</script>

<script>
    $('#add-to-cart-btn').click(function(e) {
        e.preventDefault();
        var name = $('#add-name').text();
        var id = $('#add-id').val();
        var color = $('select[name="add-color"] option:checked').val();
        var size = $('select[name="add-size"] option:checked').val();
        var quantity = $('#add-qty').val();
        $.ajax({
            type: "POST",
            dataType: 'json',
            data: {
                id: id,
                color: color,
                size: size,
                quantity: quantity,
                product_name: name
            },
            url: `{{route('add.to.cart')}}`,
            success: function(data) {

                $('#cartModal').modal('hide');
                refreshCount();
                // Start Message 
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000
                })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        title: data.success
                    })

                } else {
                    Toast.fire({
                        type: 'error',
                        title: data.error
                    })

                }
                // End Message 
            }
        })
    });
</script>

<script>
    function refreshCount() {
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: `{{route('refresh.count')}}`,
            success: function(data) {
                $('#cart-count').text(data.success);
            }
        })
    }
</script>