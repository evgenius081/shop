const goods = $('.good').toArray();
var displayedGoogs = goods.slice();

const starterDisplayedGoodsNumber = 12;

function leaveGoods(n){
    if(parseInt(n)){
        $('#goods').empty();
        if(parseInt(n) < displayedGoogs.length){
            displayedGoogs.splice(parseInt(n)-1, displayedGoogs.length - parseInt(n));
        }else{
            displayedGoogs.push(goods.slice(displayedGoogs.length - 1, parseInt(n) - 1));
        }
        for(let i  = 0; i < displayedGoogs.length + 1; i++){
            $(displayedGoogs[i]).appendTo('#goods');
        }
    }else if(!n){
        $('#goods').empty();
    }
}

function sortGoods(str){
    $('#goods').empty();
    let prices = [];
    let names = [];
    switch (str){
        case 'A - Z':
            for(i = 0; i < displayedGoogs.length; i++){
                names[i] = $(displayedGoogs[i]).children('.good-descr').children('p').text();
            }
            names.sort();
            for(i = 0; i < displayedGoogs.length; i++){
                for(j = 0; j < displayedGoogs.length; j++){
                    if(names[i] == $(displayedGoogs[j]).children('.good-descr').children('p').text()){
                        $(displayedGoogs[j]).appendTo('#goods');
                    }
                }
            }
            break;
        case 'Z - A':
            for(i = 0; i < displayedGoogs.length; i++){
                names[i] = $(displayedGoogs[i]).children('.good-descr').children('p').text();
            }
            names.sort();
            names.reverse();
            for(i = 0; i < displayedGoogs.length; i++){
                for(j = 0; j < displayedGoogs.length; j++){
                    if(names[i] == $(displayedGoogs[j]).children('.good-descr').children('p').text()){
                        $(displayedGoogs[j]).appendTo('#goods');
                    }
                }
            }
            break;
        case "Expensive":
            for(i = 0; i < displayedGoogs.length; i++){
                prices[i] = parseInt($(displayedGoogs[i]).children('.good-price').text().split(' ')[0]) ? parseInt($(displayedGoogs[i]).children('.good-price').text().split(' ')[0]) : parseInt($(displayedGoogs[i]).children().children('.good-price').text().split(' ')[0]);
            }
            prices.sort(function(a, b){return b - a});
            for(i = 0; i < displayedGoogs.length; i++){
                for(j = 0; j < displayedGoogs.length; j++){
                    if(prices[i] == parseInt($(displayedGoogs[j]).children('.good-price').text().split(' ')[0]) || prices[i] == parseInt($(displayedGoogs[j]).children().children('.good-price').text().split(' ')[0])){
                        $(displayedGoogs[j]).appendTo('#goods');
                    }
                }
            }
            break;
        case "Cheap":
            for(i = 0; i < displayedGoogs.length; i++){
                prices[i] = parseInt($(displayedGoogs[i]).children('.good-price').text().split(' ')[0]) ? parseInt($(displayedGoogs[i]).children('.good-price').text().split(' ')[0]) : parseInt($(displayedGoogs[i]).children().children('.good-price').text().split(' ')[0]);
            }
            prices.sort(function(a, b){return a - b});
            for(i = 0; i < displayedGoogs.length; i++){
                for(j = 0; j < displayedGoogs.length; j++){
                    if(prices[i] == parseInt($(displayedGoogs[j]).children('.good-price').text().split(' ')[0]) || prices[i] == parseInt($(displayedGoogs[j]).children().children('.good-price').text().split(' ')[0])){
                        $(displayedGoogs[j]).appendTo('#goods');
                    }
                }
            }
            break;
        case 'No sorting':
            for(i  = 0; i < displayedGoogs.length; i++){
                $(displayedGoogs[i]).appendTo('#goods');
            }
    }
}

$('main').delegate('.dropdown li', 'click', function () {
    if ($(this).parent().parent().children('p').text() != $(this).text()) {
        $(this).parent().parent().children('p').text($(this).text());
        if (parseInt($(this).text())) {
            leaveGoods($(this).text());
            sortGoods($("#dropdown-container-sorting").text())
        } else {
            leaveGoods($("#dropdown-container-amount").text());
            sortGoods($(this).text());
        }
    }
})

if ($('#goods').length) {
    $('<section id="goods-filters"><div><div><i class="fal fa-sort-amount-up"></i><p>Sort by:</p></div><div class="dropdown-container"><p id="dropdown-container-sorting">No sorting</p><ul class="dropdown"><li>No sorting</li><li>A - Z</li><li>Z - A</li><li>Expensive</li><li>Cheap</li></ul></div></div><div><div><p>Per page: </p></div><div class="dropdown-container" id="goods-number"><p id="dropdown-container-amount">12</p><ul class="dropdown"><li>6</li><li>12</li><li>24</li><li>36</li></ul></div></div></section>').prependTo('#main');
}

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

$('#filters-submit').click(function(e){
    e.preventDefault();
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
                }
            },
            error: function () {
                $('#goods').html('<h2>Sorry, something gone wrong</h2>');
            }
        })
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