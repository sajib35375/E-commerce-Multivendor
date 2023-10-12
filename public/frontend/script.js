(function ($){



        $("body").on('keyup','input#search',function (e){
            e.preventDefault();
            let text = $('input#search').val();

            const main_url = 'http://localhost:8000';
            if (text.length > 0){

                $.ajax({
                    data:{search:text},
                    url: main_url + "/product/search/suggestion",
                    method:'post',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success:function (data){
                        $('#searchSuggestion').html(data)
                    }
                })
            }
            if (text.length > 1) $('#searchSuggestion').html("")


        });




})(jQuery)
