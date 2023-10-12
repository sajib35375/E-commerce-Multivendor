(function ($){

    $(document).ready(function (){
        // price range
        $(document).on('change','input[name="price_range"]',function (e){
            e.preventDefault();

            let value = $(this).val();

            $('#slider-range-value2').html(value+' ৳');

        });





    });

})(jQuery)
