function drag(ev){
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev){
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    //prevents buttons from nesting in each other
    //also prevents multiple buttons from being placed in one step
    if (ev.target.classList.contains('dragTarget') && ev.target.childElementCount < 1){
        ev.target.appendChild(document.getElementById(data));
    } else if (ev.target.parentNode.classList.contains('dragTarget') && ev.target.parentNode.childElementCount < 1) {
        ev.target.parentNode.appendChild(document.getElementById(data));
    }
}

function allowDrop(ev){
    ev.preventDefault();
}