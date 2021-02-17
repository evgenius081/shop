$('main').delegate('.dropdown li', 'click', function () {
    if ($(this).parent().parent().children('p').text() != $(this).text()) {
        $(this).parent().parent().children('p').text($(this).text());
        sendFilters();
    }
})

$('<i class="fas fa-chevron-down more"></i>').insertAfter('.filter-header-wrapper');

$(".filter-var-container").hide();
$(".more").click(function () {
    $(this).next().slideToggle("slow").siblings(".more > .filter-var-container").slideUp("slow");
    $(this).toggleClass('fa-chevron-down fa-chevron-up')
});

$("#slider-range").slider({
    range: true,
    min: $('#min-amount').prop('min'),
    max: parseInt($('#max-amount').prop('max'))/10,
    values: [$('#min-amount').prop('min'), $('#max-amount').prop('max')],
    slide: function (event, ui) {
        $("#min-amount").val(ui.values[0]);
        $("#max-amount").val(ui.values[1]);
    }
});
    $("#min-amount").val($("#slider-range").slider("values", 0));
    $("#max-amount").val($("#slider-range").slider("values", 1));

    $('#min-amount').keyup(function () {
        $("#slider-range").slider({
            range: true,
            min: $('#min-amount').prop('min'),
            max: parseInt($('#max-amount').prop('max'))/10,
            values: [$("#min-amount").val(), $("#max-amount").val()],
            slide: function (event, ui) {
                $("#min-amount").val(ui.values[0]);
                $("#max-amount").val(ui.values[1]);
            }
        });
    })

    $('#max-amount').keyup(function () {
        $("#slider-range").slider({
            range: true,
            min: $('#min-amount').prop('min'),
            max: parseInt($('#max-amount').prop('max'))/10,
            values: [$("#min-amount").val(), $("#max-amount").val()],
            slide: function (event, ui) {
                $("#min-amount").val(ui.values[0]);
                $("#max-amount").val(ui.values[1]);
            }
        });
    })

function sendFilters(pageNumber = 0){
    let dataString = $('#filters').serializeArray();
    let data = {};
    // ищет разделы в фильтрах
    $('#filters').find('article').each(function(){
        data[this.id] = {};
    })
    delete data['aside-buttons'];
    data.price = {
        'min-price' : $('#min-amount').val(),
        'max-price' : $('#max-amount').val()
    }
    // ищет отмеченные поля в разделах (кроме ценыб она чуть раньше автоматом записана)
    for(const [key, val] of Object.entries(data)){
        $.each(dataString, function(d, value){
            if($(`#${key}`).find(`.filter-var-container div #${value.name}`).length > 0){
                filterName = value.name;
                data[key][filterName] = "on";
            }
        })
        if($.isEmptyObject(data[key])){
            delete data[key];
        }
    }
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
        url: '/shop/ajaxFilters/',
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

$('#filters-submit').click(function(e){
    e.preventDefault();
    sendFilters();
})

$('#aside-buttons button:first-child').click(function(e){
    e.preventDefault();
    $('#filters')[0].reset();
    $("#slider-range").slider({
        range: true,
        min: $('#min-amount').prop('min'),
        max: parseInt($('#max-amount').prop('max'))/10,
        values: [$('#min-amount').prop('min'), $('#max-amount').prop('max')],
        slide: function (event, ui) {
            $("#min-amount").val(ui.values[0]);
            $("#max-amount").val(ui.values[1]);
        }
    });
    $("#min-amount").val($('#min-amount').prop('min'));
    $("#max-amount").val($('#max-amount').prop('max'));
})

$('body').on('click', '.page-numbers', function(e){
    e.preventDefault();
    if($(e.target).data('page') != undefined){
        sendFilters($(e.target).data('page'));
    }else{
        sendFilters($(e.target).parent().data('page'));
    }
})