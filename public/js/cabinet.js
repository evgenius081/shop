$('.fa-heart').click(function(e){
    e.preventDefault();
    $(this).toggleClass('fal fas');
    if($(this).prev().prop('checked') == false){
        $(this).prev().prop('checked' , true);
    }else{
        $(this).prev().prop('checked' , false);
    }
})