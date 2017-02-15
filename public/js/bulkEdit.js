function changeBulkEdit(sel){

    if ( sel.value == ' ') {
        $(".edit-header").css("display","none");
        $(".empty-edit-header").css("display","block");
        $(".edit-button").css("display","none");
    }

    var components = ['mc','tc','hw','bs','ks'];
    for (var i =0 ; i<5 ; i++) {
        if (components[i] != sel.value){
            $("." + components[i]).css("display","none");
        }
    }

    if ( sel.value != ' ') {
        $(".empty-edit-header").css("display","none");
        $(".edit-header").css("display","block");
        $("#component").text(sel.value);

        $("." + sel.value).css("display","block");

        $(".edit-button").css("display","block");

    }
   
}