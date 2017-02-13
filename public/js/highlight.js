$(document).ready(function() 
{ 
    $("#myTable").tablesorter(); 
    setAllDifferentHeight();
} 
); 

function setAllSameHeight()
{
    var t = document.getElementById("myTable");
    for(var i=0; i<t.rows.length; i++){
        t.rows[i].style.height = "30px"; 
    }
    
}

function setAllDifferentHeight()
{
    setTimeout(function() {
        var t = document.getElementById("myTable");
        t.rows[1].style.height = "30px";
        for(var i=2; i < t.rows.length; i++) {
            var sumi = t.rows[i].cells[11].innerHTML;
            var sumiminus1 = t.rows[i-1].cells[11].innerHTML;
            t.rows[i].style.height = 30+30*(Math.abs(sumi-sumiminus1)).toString()+"px";

        }   
    }, 5);
}

