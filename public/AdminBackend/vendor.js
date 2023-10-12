(function ($){
    $(document).ready(function (){

        $('#myForm').validate({
            rules: {
                product_name: {
                    required : true,
                },
                product_selling_price: {
                    required : true,
                },
                short_desc: {
                    required : true,
                },
                product_thumbnail: {
                    required : true,
                },
                multi_img: {
                    required : true,
                },
                product_code: {
                    required : true,
                },
                product_qty: {
                    required : true,
                },
                brand_id: {
                    required : true,
                },
                category_id: {
                    required : true,
                },
                subcategory_id: {
                    required : true,
                }
            },
            messages :{
                product_name: {
                    required : 'Please Enter Product Name',
                },
                product_selling_price: {
                    required : 'Please Enter Product Selling Price',
                },
                short_desc: {
                    required : 'Please Enter Short Description',
                },
                product_thumbnail: {
                    required : 'Please Select Product Thumbnail Image',
                },
                multi_img: {
                    required : 'Please Select Multi Image',
                },
                product_code: {
                    required : 'Please Enter Product Code',
                },
                product_qty: {
                    required : 'Please Enter Product Quantity',
                },
                brand_id: {
                    required : 'Please Select Brand Name',
                },
                category_id: {
                    required : 'Please Select Category Name',
                },
                subcategory_id: {
                    required : 'Please Select SubCategory Name',
                },
            },
            errorElement : 'span',
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });


        $(document).on('change','input#image-thumb',function (e){
            e.preventDefault();

            let url = URL.createObjectURL(e.target.files[0]);
            $('img#thumbnail').attr('src',url).width('200px').height('200px');
        })

        $(document).on('change','input#image-multiple',function (e){
            e.preventDefault();
            // console.log(e.target.files.length)
            let img_multi='';
            for (let i=0; i< e.target.files.length;i++){
                // console.log(e.target.files)
                let url = URL.createObjectURL(e.target.files[i]);
                img_multi += `<img src=${url} />`;
            }
            // console.log(img_multi)
            $('.multi').html(img_multi);
        });

        $(document).on('change','select[name="category_id"]',function (e){
            e.preventDefault();

            let category_id = $(this).val();
            let main_domain = 'http://localhost:8000/';
            if (category_id){
                $.ajax({
                    url : main_domain+"select/vendor/subcategory/"+category_id,
                    type : "GET",
                    dataType : "json",
                    success:function (data){
                        $('select[name="subcategory_id"]').empty();
                        $.each(data,function (key,value){
                            $('select[name="subcategory_id"]').append('<option value="'+value.id+'">'+value.sub_name+'</option>')
                        });
                    },
                });
            }else{
                alert('danger')
            }
        });




    })


})(jQuery)
