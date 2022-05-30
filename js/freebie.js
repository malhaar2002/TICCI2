var orders = new Array();
function add_order(item){
    if(orders.length <= 30){
        if(!orders.includes(item)){
        orders.push(item);
        let mitem = item.replace(/\s+/g, ""); mitem = mitem+"-cart";
        document.getElementById(mitem).innerText = "REMOVE";
        document.getElementById(mitem).style.backgroundColor = "#cda45e";
        document.getElementById(mitem).style.color = "white";
        document.getElementById("order_num").innerText = orders.length;
        }
        else{
        let riv = orders.indexOf(item);
        let mitem = item.replace(/\s+/g, ""); mitem = mitem+"-cart";
        orders.splice(riv, 1);
        document.getElementById(mitem).innerText = "ADD TO CART";
        document.getElementById(mitem).style.backgroundColor = "transparent";
        document.getElementById(mitem).style.color = "white";
        document.getElementById("order_num").innerText = orders.length;
        }
    }
    else{
        alert("We're sorry, you can't add more than 30 items to the cart at once.");
    }
}
function submit_orders(){
    if (orders.length > 0){
        let link = "";
        for (let i = 0; i < orders.length; i++){
            link += orders[i]+"<e>";
        }
    
        document.getElementById("f-order-form-items").setAttribute("value", link);
        document.getElementById("f-order-form").submit();
    }
    else{
        alert("You haven't added any item to your cart");
    }
}


  