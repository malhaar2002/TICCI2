function pay_now(phone, email) {
    var amt = 300;
    var delivery_time = '2022-05-07 11:49:52';
    var delivery_location = 'Stilt Area';
    var instructions = 'Please make good food';
    var contact = '9864028759'

    var options = {
        "key": "rzp_test_m8D9kQpB5lY3So", // Enter the Key ID generated from the Dashboard
        "amount": amt*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
        "currency": "INR",
        "name": "Flavours of the North",
        "description": "Test Transaction",
        "prefill": {'contact': phone, 'email': email},
        "readonly": {'email': true, 'contact': true},
        "image": "/assets/css/img/about1.jpg",
        "handler": function (response){
            //   console.log(response);
            jQuery.ajax({
                type: 'post',
                url: 'payment_process.php',
                data: "payment_id="+response.razorpay_payment_id+"&amt="+amt+"&name="+name+"&delivery_time="+delivery_time+"&delivery_location="+delivery_location+"&instructions="+instructions+"&contact="+contact,
                success:function(result)  {
                    window.location.href = "thank_you.php";
                }
            });
        }
    };
    var rzp1 = new Razorpay(options);
    document.getElementById('rzp-button1').onclick = function(e){
        rzp1.open();
        e.preventDefault();
    }
    
}