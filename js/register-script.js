$('#register-form').on('submit', function(){
    // event.preventDefault();
    let username = $('#username').val();
    let pass = $('#password').val();
    let confirm = $('#confirm').val();
    let error =  $('#error');

    if(username.trim() === ""){
        error.text('Please enter a username!');
        return false;
    }
    else if(pass.trim() === ""){
        error.text('Please enter a password!');
        return false;
    }
    else if(pass !== confirm){
       error.text('Passwords do not match!');
       console.log(pass, confirm);
        return false;
    }
    else{
        return true;
    }
});