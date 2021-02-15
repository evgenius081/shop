$('input[name="search-input"]').keyup(function(e){
    let name = $(this).val().toLowerCase();
    if($(this).val().length > 0) {
        $.ajax({
            url: '/stock/ajaxSearchByTitle',
            data: {
                name: name
            },
            type: 'GET',
            success: function (res) {
                if (res.length > 0) {
                    res = res.substring(0, res.length - 1);
                    $('#stock-gallery-container').html(res);
                    $('#subm').css('display', 'block');
                    $('#stock-pagination').css("display", 'none');
                } else {
                    $('#stock-gallery-container').html('<h2>Sorry, nothing</h2>');
                    $('#subm').css('display', 'none');
                    $('#stock-pagination').css("display", 'none');
                }
            }, error: function () {
                $('#stock-gallery-container').html('<h2>Sorry, something gone wrong</h2>');
                $('#stock-pagination').css("display", 'none');
            }
        })
    }else{
        getAll();
    }
});

function getAll(){
    $.ajax({
        url: '/stock/ajaxGetAll',
        data:{
            page: $('.current').html()
        },
        type: 'GET',
        success: function (res) {
            if (res.length > 0) {
                res = res.substring(0, res.length - 1);
                $('#stock-gallery-container').html(res);
                $('#subm').css('display', 'block');
                $('#stock-pagination').css("display", 'flex');
            } else {
                $('#stock-gallery-container').html('<h2>Sorry, nothing</h2>');
                $('#stock-pagination').css("display", 'none');
                $('#subm').css('display', 'none');
            }
        }, error: function () {
            $('#stock-gallery-container').html('<h2>Sorry, something gone wrong</h2>');
            $('#stock-pagination').css("display", 'none');
        }
    })

}

$('#main').click(function(e){
    if(e.target.className == 'fal fa-heart' || e.target.className == 'fa-heart fas' || e.target.className == 'fa-heart fal'){
        e.preventDefault();
        $(e.target).toggleClass('fal fas');
        if($(e.target).prev().prop('checked') == false){
            $(e.target).prev().attr('checked' , true);
        }else{
            $(e.target).prev().prop('checked' , false);
        }
    }
})

$(window).ready(function(){
    getAll();
});