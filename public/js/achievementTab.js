function changeAchievementTab(sel){

    var components = ['lib','qs','aic','su','hd','bw','ka','cs'];
    for (var i =0 ; i<8 ; i++) {
        if (components[i] != sel.value){
            $("." + components[i]).css("display","none");
        }
    }

    $("." + sel.value).css("display","block");
    $(".edit-button").css("display","block");

}