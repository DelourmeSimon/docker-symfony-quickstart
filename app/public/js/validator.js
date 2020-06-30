'use strict';
window.addEventListener("DOMContentLoaded", (event) => {

let callMeButton = document.getElementById('user_callback_request_callMe');

	callMeButton.onclick = function(e) {
		e.stopPropagation();
		e.preventDefault();

		let phoneNumber = document.getElementById('user_callback_request_phoneNumber').value;
		let countryCode = document.getElementById('user_callback_request_country').value;

		if (!phoneNumber || !countryCode) {
			alert("Please fill phone number and country code");
			return;
		}

		let request = new XMLHttpRequest();
		request.open('POST', 'http://localhost:8000/validate-phone');
		request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		request.send('phoneNumber='+phoneNumber+'&countryCode='+countryCode);

		request.addEventListener('readystatechange', function() {
			try {
				if(request.readyState === XMLHttpRequest.DONE) {
			        var response = JSON.parse(request.response);
					if (request.status === 200) {
						console.log(response);
						if (response.valid) {
							document.getElementById('user_callback_request_internationalPhoneNumber').value = response.phoneNumberInternational;
							document.getElementById('callback_request_form').submit();
						} else {
							alert('Warning: phone number is not valid.');
						}
					} else {
				    	alert(response);
					}
				}
			} catch (e) {
				alert(e);
			}
		});
	};
});
