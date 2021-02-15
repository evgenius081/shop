canRegister= [0,0,0,0];
function minus(id){
    if(canRegister[id] != 0){
        canRegister[id] = 0;
    }
    ableButton();
}

function plus(id){
    if(canRegister[id] != 1){
        canRegister[id] = 1;
        ableButton();
    }
}
function ableButton(){
    can = true;
    canRegister.forEach(element => {
        if(element == 0){
            can = false;
        }
    });
    if(can){
        $('.sign-in').prop('disabled', false);
    }else{
        $('.sign-in').attr('disabled', true);
    }
}

$('#reg-email').keyup(function(e){
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(!re.test(String($('#reg-email').val()))){
        $('#reg-email').css('border-bottom', '3px solid #c62828');
        $('.password').attr('title', 'Incorrect email');
        minus(0);
    }else{
        $('#reg-email').css('border-color', 'rgba(255, 255, 255, 0.23) rgba(255, 255, 255, 0.23) rgb(124, 179, 66)');
        $('#reg-email').css('border-bottom', '2px solid rgb(124, 179, 66)');
        plus(0);
    }
});

$('#reg-password').keyup(function(e){
    if(this.value.length < 8){
        $('#reg-password').css('border-bottom', '3px solid #c62828');
        $('#reg-password').attr('title', 'Too short password');
        minus(1);
    }else if(!this.value.match(/\d/g)){
        $('#reg-password').css('border-bottom', '3px solid #c62828');
        $('#reg-password').attr('title', 'There must be digits in your password');
        minus(1);
    }else{
        $('#reg-password').css('border-color', 'rgba(255, 255, 255, 0.23) rgba(255, 255, 255, 0.23) rgb(124, 179, 66)');
        $('#reg-password').css('border-bottom', '2px solid rgb(124, 179, 66)');
        plus(1);
    }
});

$('#confirm-password').keyup(function(e){
    if(this.value == $('#reg-password').val()){
        $('#confirm-password').css('border-color', 'rgba(255, 255, 255, 0.23) rgba(255, 255, 255, 0.23) rgb(124, 179, 66)');
        $('#confirm-password').css('border-bottom', '2px solid rgb(124, 179, 66)');
        plus(2);
    }else{
        $('#confirm-password').css('border-bottom', '3px solid #c62828');
        $('#confirm-password').attr('title', 'Passwords doesn`t match');
        minus(2);
    }
})

$('#reg-login').keyup(function(e){
    if(this.value.length < 4){
        $('#reg-login').css('border-bottom', '3px solid #c62828');
        $('#reg-login').attr('title', 'Too short login');
        minus(3);
    }else{
        $('#reg-login').css('border-color', 'rgba(255, 255, 255, 0.23) rgba(255, 255, 255, 0.23) rgb(124, 179, 66)');
        $('#reg-login').css('border-bottom', '2px solid rgb(124, 179, 66)');
        plus(3);
    }
});