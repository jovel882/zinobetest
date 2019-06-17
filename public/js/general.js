/*Funciones utiles en todo el sitio
@author John Fredy Velasco Bareño <jovel882@gmail.com>
*/
function errorctr(status,ctr,txt=false){
    var parent=ctr.closest(".form-group");
    if(status==false){
        parent.addClass("has-error");
        if(ctr.siblings(".help-block").length>0){
            ctr.siblings(".help-block").html('<span class="glyphicon glyphicon glyphicon-remove-circle"></span> '+txt);
        }
        else{
            parent.find(".help-block").first().html('<span class="glyphicon glyphicon-remove-circle"></span> '+txt);
        }
    }
    else{
        parent.removeClass("has-error");
        parent.addClass("has-success");
        if(ctr.siblings(".help-block").length>0){
            ctr.siblings(".help-block").html('<span class="glyphicon glyphicon glyphicon-thumbs-up"></span>');
        }
        else{
            parent.find(".help-block").first().html('<span class="glyphicon glyphicon glyphicon-thumbs-up"></span>');
        }
    }    
}
function clear_ErrorCtr(ctr){
    ctr.closest(".form-group").removeClass("has-error");
    ctr.siblings(".help-block").html('');
}
function errorgroup(status,ctr,txt=false){
    var parent=ctr.closest(".row");
    if(status==false){
        parent.addClass("has-error");
        ctr.html('<i class="fa fa-times-circle-o"></i> '+txt);
    }
    else{
        parent.removeClass("has-error");
        ctr.html('');
    }    
}
function moveScroolElement(element){
    if(element.length>0){
        $('html, body').animate({
            scrollTop: (element.offset().top)
        },500);    
    }
}
function validateInteger(value){
    if(value!=""){
        return /^[0-9]*$/g.test(value);
    }
    else{
        return false;
    }
}
function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(email!=""){
        return re.test(email);
    }
    else{
        return false;
    }  
}
function validatePassword(password) {
    var re = /^(?=[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ0-9!.@\-#\+\$%\^&\*\?_~\/ ]*\d[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ0-9!.@\-#\+\$%\^&\*\?_~\/ ]*)[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ0-9!.@\-#\+\$%\^&\*\?_~\/ ]{6,}$/;
    if(password!=""){
        return re.test(password);
    }
    else{
        return false;
    }  
}