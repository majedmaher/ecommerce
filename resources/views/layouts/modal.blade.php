<div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">
                    <!-- Your Shopping Cart -->
                    @php $lang = getLanguage() @endphp
                    {{$lang == 'ar' ? 'اضف الى السلة' : 'add to cart'}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-image">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">{{$lang == 'ar' ? 'المنتج' : 'Product'}}</th>
                            <th scope="col">{{$lang == 'ar' ? 'السعر' : 'Price'}}</th>
                            <th scope="col">{{$lang == 'ar' ? 'الحجم' : 'Size'}}</th>
                            <th scope="col">{{$lang == 'ar' ? 'اللون' : 'Color'}}</th>
                            <th scope="col">{{$lang == 'ar' ? 'الكمية' : 'Quantity'}}</th>
                            <th scope="col">{{$lang == 'ar' ? 'الاجمالي' : 'Total'}}</th>
                            <!-- <th scope="col">Actions</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <input id="add-id" type="hidden" value="">

                        <tr class="tr-modal">
                            <td class="w-25">
                                <img id="add-img" src="" class="img-fluid img-thumbnail" alt="">
                            </td>
                            <td class="align-middle" id="add-name"></td>
                            <td class="align-middle" id="add-price"></td>
                            <td class="align-middle">
                                <select name="add-size" id="add-size">

                                </select>
                            </td>
                            <td class="align-middle">
                                <select name="add-color" id="add-color">

                                </select>
                            </td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button onclick="calculate()" class="btn btn-sm btn-primary btn-minus">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input id="add-qty" type="text" class="form-control form-control-sm bg-secondary text-center" value="1">
                                    <div class="input-group-btn">
                                        <button onclick="calculate()" class="btn btn-sm btn-primary btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td id="add-total" class="align-middle"></td>
                            <!-- <td>
                                <a href="#" class="btn btn-danger btn-sm">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td> -->
                        </tr>
                    </tbody>
                </table>
                <!-- <div class="d-flex justify-content-end">
                    <h5>Total: <span class="price text-primary">89$</span></h5>
                </div> -->
            </div>
            <div class="modal-footer border-top-0 d-flex justify-content-between">
                <button id="closeModel" type="button" class="btn btn-secondary" data-dismiss="modal">{{$lang == 'ar' ? 'اغلاق' : 'Close'}}</button>
                <button id="add-to-cart-btn" type="button" class="btn btn-primary">{{$lang == 'ar' ? 'اضف الى السلة' : 'Add to cart'}}</button>
            </div>
        </div>
    </div>
</div>