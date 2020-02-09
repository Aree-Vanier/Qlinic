function formatNumber(target) {
    let num = target.value;
    //Limit number length
    if(num.length > 12){
        num = num.substr(0, 12);
    }
    //Remove existing dashes
    num = num.replace(/-/g, "");
    //Add new dashes
    num = num.replace(/^([0-9]{3})/, "$1-");
    num = num.replace(/^([0-9]{3}-[0-9]{3})/, "$1-");
    //Remove trailing dash
    if(num.endsWith("-")){
        num = num.substr(0, num.length-1)
    }
    //Update value
    target.value = num;
}