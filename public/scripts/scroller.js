let scrollers = [];

window.addEventListener('load', function () {
    console.log("Initializing scrollers");
    //Get all scrollers on the page
    for (let div of document.getElementsByClassName('scroller')) {
        let scroller = {root: div, items: [], input:null};
        //Iterate over child nodes
        for (let item of div.childNodes) {
            //Get all scroll items
            if (item.nodeName === "#text") continue;

            if (item.classList.contains("scrollItem")) {
                scroller.items.push(item);
                //Mark selected element as selected
                if (item.classList.contains("selected")) {
                    scroller.selected = item;
                    if(scroller.input != null){
                        scroller.input.value = item.id;
                    }
                }
                //Add onclick to scroll items
                item.onclick = function () {
                    if (scroller.selected === item)
                        return;
                    scroller.selected.classList.remove("selected");
                    item.classList.add("selected");
                    scroller.selected = item;
                    if(scroller.input != null){
                        scroller.input.value = item.id;
                    }
                };
            }

            if (item.classList.contains("scrollerInput")) {
                scroller.input = item;
            }
        }
        //Save scroller
        scrollers.push(scroller)
    }
});
