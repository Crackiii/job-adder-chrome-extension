$(".show-login").click(function(){
    $(".user-signup").hide();
    $(".user-login").show();
})

$(".show-signup").click(function(){
    $(".user-login").hide();
    $(".user-signup").show();
})



//===========================================================
//==============================================  S I G N U P
//===========================================================


$("#su_form").submit(function(e){
    e.preventDefault();
    let ev = e.target;

    $(".su-submit").prop('disabled', true);
    $(".su-submit").val("Processing...");

    $.ajax({
        method:"POST",
        url:"https://fiverr-projects.000webhostapp.com/auth.php",
        data:$(ev).serialize() + "&reg_new_user=true",
    }).then(function(res){
        

        switch(res.toLowerCase()){
            case "not-checked":{
                $(".su-error").show();
                $(".user-signup").css({"animation":"wobble 1s"});
                $(".su-error").text("You must agree to the terms & conditions !");
                $(".su-submit").prop('disabled', false);
                $(".su-submit").val("Sign Up");
                break;
            }
            case "empty-box":{
                $(".su-error").show();
                $(".user-signup").css({"animation":"wobble 1s"});
                $(".su-error").text("All the fields are required ! ");
                $(".su-submit").prop('disabled', false);
                $(".su-submit").val("Sign Up");
                break;
            }
            case "great":{
                $(".su-error").hide();
                $("#su_form").trigger("reset");
                $(".user-signup").css({"transform":"scale(0)","transition":"all .3s"}).hide(400);
                $(".su-welcome").show();
                break;
            }
        }


    })

})

//========================================================
//============================================== L O G I N
//========================================================



$("#lg_form").submit(function(e){
    e.preventDefault();
    let ev = e.target;

    $(".lg-submit").val("Processing...");
    $(".lg-submit").prop('disabled', true);
    
    $.ajax({
        method:"POST",
        url:"https://fiverr-projects.000webhostapp.com/auth.php",
        data:$(ev).serialize() + "&login_user=true",
    }).then(function(res){
        

        switch(res.toLowerCase()){
            case "empty-box":{
                $(".lg-error").show();
                $(".user-login").css({"animation":"wobble 1s"});
                $(".lg-error").text("All the fields are required ! ");
                $(".lg-submit").val("Login");
                $(".lg-submit").prop('disabled', false);
                break;
            }
            case "no-user":{
                $(".lg-error").show();
                $(".user-login").css({"animation":"wobble 1s"});
                $(".lg-error").text("No Such User Found ! ");
                $(".lg-submit").val("Login");
                $(".lg-submit").prop('disabled', false);
                break;
            }
            case "great":{
                $(".lg-error").hide();
                $("#lg_form").trigger("reset");
                $(".user-login").css({"transform":"scale(0)","transition":"all .3s"}).hide(400);
                $(".lg-welcome").show();
                break;
            }
        }


    })

})




































