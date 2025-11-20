$(function(){
    //console.log("js running");
    $("#accountType").change(function () { 
        const accountT = $(this).val().trim();
        if (accountT=="guest"){
            $("#signUpAddress").attr("disabled",true);
            $("#signUpPhoneNum").attr("disabled",true);
        }else{
            $("#signUpAddress").attr("disabled",false);
            $("#signUpPhoneNum").attr("disabled",false);
        }
    });

    //submit validation, no empty allow
    $("#signUpSubmit").click(function (e) { 
        const pwd = $("#signUpPassword").val().trim();
        const con = $("#passwordConfirm").val().trim();
        const adrs = $("#signUpAddress").val().trim();
        const pNum = $("#signUpPhoneNum").val().trim();
        if(adrs===0){
            e.preventDefault();
            alert("please enter address");
        }else if(pNum===0){
            e.preventDefault();
            alert("please enter phone number");
        }else if(pwd.length===0||con.length===0){
            e.preventDefault();
            alert("please enter password");
        }else{
            if (pwd.length<6||pwd.length>255) {
                e.preventDefault();
                alert("at least 6 characters and at most 255 characters");
            }
            if (pwd!=con) {
                e.preventDefault();
                alert("Check your password, two password should be same");
            }
        }
    });

})
