function setElementClass(id, classVal){
    var bar = document.getElementById(id);
    bar.setAttribute("class", classVal);
}


function toggleShow(id){
    var bar = document.getElementById(id);
    var disp = bar.style.display;
    if (disp == "block")
    	disp = "none";
    else
    	disp = "block";
    //bar.setAttribute("class", animClass);
}


function showElement(id){
    var bar = document.getElementById(id);
    bar.style.display = "block";
    bar.setAttribute("class", animClass);
}

function hideElement(id){
    var bar = document.getElementById(id);
    bar.style.display = "none";
}