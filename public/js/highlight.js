$(document).ready(function() 
{ 
    $("#myTable").tablesorter(); 
    setHeightByAttr('Sum');
} 
); 

function setAllSameHeight()
{
    var t = document.getElementById("myTable");
    for(var i=0; i<t.rows.length; i++){
        t.rows[i].style.height = "30px"; 
    }
    
}

function setHeightByAttr(attr)
{
    //find the index of the attribute and save it in a variable called index

    

    setTimeout(function() {
        var index = null;
        var t = document.getElementById("myTable");
        for(var i = 0; i < t.rows[0].cells.length; i++){
            if(t.rows[0].cells[i].innerText == attr+"\n"){
                index = i;
                break
            }
        }
        t.rows[1].style.height = "30px";
        for(var i=2; i < t.rows.length; i++) {
            var sumi = t.rows[i].cells[index].innerHTML;
            var sumiminus1 = t.rows[i-1].cells[index].innerHTML;
            t.rows[i].style.height = 30+30*(Math.abs(sumi-sumiminus1)).toString()+"px";

        }   
    }, 5);
}

