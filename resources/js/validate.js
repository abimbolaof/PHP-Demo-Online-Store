function validateEmail(field_id){
    var email = $("#" + field_id).val();
    var patt = /^[a-z0-9\.]+@{1}\w+\.{1}[a-z]+$/;
    if (email && patt.test(email)){
        return true;
    }else{
        alert("Invalid Email Address");
        return false;
    }
}