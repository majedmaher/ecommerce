    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('lib/owlcarousel/owl.carousel.min.js')}}"></script>

    <!-- Contact Javascript File -->
    <script src="{{asset('mail/jqBootstrapValidation.min.js')}}"></script>
    <script src="{{asset('mail/contact.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset('js/main.js')}}"></script>



    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            icon: 'success',
            showConfirmButton: false,
            timer: 3000
        })
        if (`{{session()->has('success')}}`) {
            Toast.fire({
                type: 'success',
                title: `{{session()->get('success')}}`
            })

        } else if (`{{session()->has('error')}}`) {
            const ToastError = Swal.mixin({
                toast: true,
                position: 'top-end',
                icon: 'error',
                showConfirmButton: false,
                timer: 3000
            })
            ToastError.fire({
                type: 'error',
                title: `{{session()->get('error')}}`
            })
        }
        $('#subscribe_btn').click(function(e) {
            e.preventDefault();

            var email = $('#subscribe_email').val();
            $.ajax({
                type: "POST",
                dataType: 'json',
                data: {
                    email: email,
                },
                url: `{{route('subscribe.store')}}`,
                success: function(data) {
                    $('#subscribe_email').val('');

                    // Start Message 

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

        })

        $('#newsletter_button').click(function(e) {
            e.preventDefault();

            var name = $('#newsletter_name').val();
            var email = $('#newsletter_email').val();
            $.ajax({
                type: "POST",
                dataType: 'json',
                data: {
                    name: name,
                    email: email,
                },
                url: `{{route('newsletter.store')}}`,
                success: function(data) {
                    $('#newsletter_name').val('');
                    $('#newsletter_email').val('');

                    // Start Message 

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

        })
    </script>