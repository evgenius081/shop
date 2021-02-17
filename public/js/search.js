$('main').delegate('.dropdown li', 'click', function () {
    if ($(this).parent().parent().children('p').text() != $(this).text()) {
        $(this).parent().parent().children('p').text($(this).text());
        sendFilters();
    }
})

function sendFilters(pageNumber = 0){
    let data = {};
    data.search = $('#goods').data('search');
    // ищет разделы в фильтрах
    data.sort = {};
    data.sort.limit = $('#dropdown-container-amount').text();
    if($('#dropdown-container-sorting').text() != 'No sorting'){
        switch($('#dropdown-container-sorting').text()){
            case 'A - Z':{
                data.sort.order = 'ASC/name';
                break;
            }
            case 'Z - A':{
                data.sort.order = 'DESC/name';
                break;
            }
            case 'Expensive':{
                data.sort.order = 'DESC/price';
                break;
            }
            case 'Cheap':{
                data.sort.order = 'ASC/price';
                break;
            }
        }
    }
    data.page = {};
    if($('#pagination').length){
        if($('.current').length){
            data.page.current = parseInt($('.current').text());
        }
        if(pageNumber != 0){
            data.page.number = pageNumber;
        }
    }else{
        data.page.current = 1;
    }
    $.ajax({
        url: '/shop/ajaxSearchFilters/',
        data: {
            data: JSON.stringify(data).toLowerCase(),
        },
        type: 'GET',
        success: function (res) {
            if (res.length > 0) {
                $('#goods').html(res);
            } else {
                $('#goods').html('<h2>Sorry, no such products</h2>');
                if($('#pagination').length){
                    $('#pagination').remove();
                }
            }
        },
        error: function () {
            $('#goods').html('<h2>Sorry, something gone wrong</h2>');
        }
    })
}

$('body').on('click', '.page-numbers', function(e){
    e.preventDefault();
    if($(e.target).data('page') != undefined){
        sendFilters($(e.target).data('page'));
    }else{
        sendFilters($(e.target).parent().data('page'));
    }
})