$('main').on('click', '#amount-plus', function(e){
    currentValue = $('#amount-field').val();
    if(currentValue <  parseInt($('#amount-field').prop('max'))){
        $('#amount-field').val(++currentValue);
    }
})

$('main').on('click', '#amount-minus', function(){
    currentValue = $('#amount-field').val();
    if(currentValue > 1){
        $('#amount-field').val(--currentValue);
    }
})