function changeCartButtonsClasses(id = -1){
    $('.good').each(function(){
        if($(this).find('.fa-shopping-cart').parent().data('id') == id && $(this).find('.fa-shopping-cart').hasClass("fas")){
            $(this).find('.fa-shopping-cart').toggleClass('fas fal');
        }else if(id == -1 && $(this).find('.fa-shopping-cart').hasClass("fas")){
            $(this).find('.fa-shopping-cart').toggleClass('fas fal');
        }
    })
    if($('#buy').length != 0){
        $('#buy').text('BUY');
    }
}

function sendAJAX(data, url, el, def){
    $.ajax({
        url: url,
        data: {
            data: data,
        },
        type: 'GET',
        success: function (res) {
            if(res === 'false' || res === ''){
                alert('Something gone wrong');
            }else if(res === 'true'){
                if((!el.hasClass('fas') && def == 'fal') || def == 'far'){
                    el.toggleClass(`${def} fas`);
                }
            }
        },
        error: function () {
            alert('Something bad happened, I can feel it')
        }
    })
}

function addScrollUpButton(){
    var screenHeight = document.documentElement.clientHeight;
    var screenWidth = document.documentElement.clientWidth;
    var scrollHeight = Math.max(
        document.body.scrollHeight, document.documentElement.scrollHeight,
        document.body.offsetHeight, document.documentElement.offsetHeight,
        document.body.clientHeight, document.documentElement.clientHeight
    );

    if(scrollHeight > screenHeight  * 2) {
        scrollUpButton = $('<div id="scroll-up-button"><i class="fal fa-arrow-circle-up fa-2x"></i></div>');

        if(!$('#main #scroll-up-button').length){
            $('#main').append(scrollUpButton);
        }

        var scrollUp = $('#scroll-up-button');
        scrollUp.click(function () {
            $('html, body').stop().animate({scrollTop: 0}, 777);
        });

        if (window.pageYOffset >= screenHeight && window.pageYOffset + screenHeight - (screenWidth + 17) * 0.055 < scrollHeight - 300) {
            scrollUp.css('display', 'block');
            $('#scroll-up-button i').css('color', '#000');
        } else if (window.pageYOffset + screenHeight - (screenWidth + 17) * 0.055 >= scrollHeight - 300) {
            $('#scroll-up-button i').css('color', '#fff');
        } else {
            scrollUp.css('display', 'none');
        }

        window.onscroll = function () {
            var screenHeight = document.documentElement.clientHeight;
            var screenWidth = document.documentElement.clientWidth;
            var scrollHeight = Math.max(
                document.body.scrollHeight, document.documentElement.scrollHeight,
                document.body.offsetHeight, document.documentElement.offsetHeight,
                document.body.clientHeight, document.documentElement.clientHeight
            );
            if (window.pageYOffset >= screenHeight && window.pageYOffset + screenHeight - (screenWidth + 17) * 0.055 < scrollHeight - 300) {
                scrollUp.css('display', 'block');
                $('#scroll-up-button i').css('color', '#000');
            } else if (window.pageYOffset + screenHeight - (screenWidth + 17) * 0.055 >= scrollHeight - 300 && scrollHeight > screenHeight  * 2) {
                scrollUp.css('display', 'block');
                $('#scroll-up-button i').css('color', '#fff');
            } else {
                scrollUp.css('display', 'none');
            }
        };
    }else if($('#main #scroll-up-button').length){
        $('#main #scroll-up-button').css('display', 'none');
    }
}

$(window).load(function() {
    addScrollUpButton();
    $('#main').on('click', '.fa-heart' ,(function (e){
        if(typeof $(e.target).parent().data('id') != 'undefined'){
            let url = '/shop/ajax';
            if($(e.target).attr('class').includes('far')){
                url += 'AddToChosen/';
            }else{
                url += 'RemoveFromChosen/';
            }
            sendAJAX($(this).parent().data('id'), url, $(e.target), 'far');
        }

    }))

    $('#main').on('click', '.fa-shopping-cart' ,(function (e){
        if(typeof $(e.target).parent().data('id') != 'undefined'){
            data = {}
            data.id = $(e.target).parent().data('id');
            data.img = $(this).parents('.good').find('img').prop('src');
            data.price = $(this).parents('.good').find('.good-price').text();
            data.name = $(this).parents('.good').find('.good-descr p').text();
            data.amount = 1;
            sendAJAX(JSON.stringify(data), '/shop/ajaxAddToCart/', $(e.target), 'fal');
        }

    }))

    $('#open-shopping-cart').click(function(e){
        e.preventDefault();
        $('html').css('overflow-y', 'hidden');
        $.ajax({
            url: '/shop/openCart/',
            type: 'GET',
            success: function (res) {
                $('#main').append(res);
            },
            error: function () {
                alert('Something bad happened, I can feel it')
            }
        })
    })

    $('#main').on('click', '#reset-cart', ()=> {
        $.ajax({
            url: '/shop/clearCart/',
            type: 'GET',
            success: function (res) {
                if(res == 'true'){
                    $('#content').html('<h3>Your cart is empty(</h3>');
                    $('#cart-buttons').html('<a id="continue-shopping-empty">Continue shopping</a>')
                    changeCartButtonsClasses();
                }else{
                    alert('Something gone wrong');
                }
            },
            error: function () {
                alert('Something bad happened, I can feel it')
            }
        })
    })


    $('#main').on('click', '#continue-shopping-empty, #continue-shopping', ()=>{
        $('#cart-wrapper').remove();
        $('html').css('overflow-y', 'auto');
    })

    $('#main').on('click', '.fa-trash', function(){
        $.ajax({
            url: '/shop/ajaxDeleteFromCart/',
            data : {
                data: $(this).data('id'),
            },
            type: 'GET',
            success: function (res) {
                let results = res.split('/');
                if(res.includes('true')){
                    $('#content').find(`.container-good[data-id="${results[3]}"]`).remove();
                    let amount = parseInt($('#total-quantity').children('p:last-child').text());
                    let price = parseInt($('#total-sum').children('p:last-child').text().replace(' USD', ''));
                    $('#total-quantity').children('p:last-child').text((amount - parseInt(results[2])));
                    $('#total-sum').children('p:last-child').text((price - parseInt(results[1]) * parseInt(results[2])) + ' USD');
                    changeCartButtonsClasses(results[3]);
                }else if(res.includes('clear')){
                    changeCartButtonsClasses(results[1]);
                    $('#content').html('<h3>Your cart is empty(</h3>');
                    $('#cart-buttons').html('<a id="continue-shopping-empty">Continue shopping</a>')
                }
            },
            error: function () {
                alert('Something bad happened, I can feel it')
            }
        })
    })

    $('nav').on('click', '.fa-user', function(e){
        e.preventDefault();
        $this = e.target;
        $($this).parent().next().toggleClass('active-modal disactive-modal');
    })

    $('#main').on('click', '#buy', function(e){
        e.preventDefault();
        let data = {}
        data.id = $(e.target).data('id');
        data.img = $(this).parents('#main').find('img').prop('src').replace('mini_', '');
        data.price = $(this).parents('#main').find('#current-price').text().replace('Price: ', '');
        data.name = $(this).parents('#main').find('h1').text();
        data.amount = $('input[type="number"]').val();
        $.ajax({
            url: '/shop/ajaxAddToCart/',
            data: {
                data : JSON.stringify(data),
            },
            type: 'GET',
            success: function () {
                $('#buy').text('ADDED');
                $('#input[type="number"]').val(1);
                let text = $('#good-amount').html();
                $('#good-amount').remove();
                setTimeout(function(){
                    $('#buy').text('ADD MORE');
                    $('#buy').after(`<div id="good-amount">${text}</div>`);
                }, 3000)
            },
            error: function () {
                alert('Something bad happened, I can feel it')
            }
        })
    })

    $('body').click(function (e){
        if($('#user-modal').hasClass('active-modal') && !$(e.target).hasClass('fa-user')){
            $('#user-modal').toggleClass('active-modal disactive-modal');
        }
    })

    window.onresize = function(){
        addScrollUpButton();
    }
});