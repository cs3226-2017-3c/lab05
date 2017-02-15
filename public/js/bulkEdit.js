function changeBulkEdit(sel){

    var components = ['mc','tc','hw','bs','ks'];
    for (var i =0 ; i<5 ; i++) {
        if (components[i] != sel.value){
            $("." + components[i]).css("display","none");
        }
    }

    $("." + sel.value).css("display","block");
    $(".edit-button").css("display","block");

}