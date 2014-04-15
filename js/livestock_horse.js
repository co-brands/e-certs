function figurePayment()
	{
//	window.alert("start of horse figure payment");
		if (document.getElementById('num_horse_country_01').value) {var numHorse1 = document.getElementById('num_horse_country_01').value;} else {var numHorse1 = 0;}
		if (document.getElementById('num_horse_country_02').value) {var numHorse2 = document.getElementById('num_horse_country_02').value;} else {var numHorse2 = 0;}
		
		var totalHorse = parseInt(numHorse1,2)+parseInt(numHorse2,2);
				document.getElementById('totalHorse').value = totalHorse;
		
		if (document.getElementById('remove_min_fee').checked) {} else {}
		if (document.getElementById('remove_svc_chg_fee').checked) {} else {}
		if (document.getElementById('horse_movement_01').checked) {} else {}
		if (document.getElementById('horse_movement_02').checked) {} else {}
		if (totalHorse < 1) {
			var minimumFee = 0;
		} else {
			var minimumFee = 15.00;
		}
		
		if (document.getElementById('remove_ten_only').checked) {} else {}
//		if this is clicked, it removes every fee but a $10 service charge
		if (document.getElementById('remove_min_fee').checked) minimumFee = 0;
		if (document.getElementById('remove_svc_chg_fee').checked) serviceChargeFee = 0;
		
		if (document.getElementById('remove_ten_only').checked) minimumFee = 0;
//		this has to be determined how to do it TODO
		document.getElementById('minimumFee').value = minimumFee.toFixed(2);
//		document.getElementById('serviceChargeFee').value = serviceChargeFee;
		
		var totalDueFee = (parseInt(minimumFee,2)).toFixed(2);
		document.getElementById('totalDueFee').value = totalDueFee;
//		window.alert("end of horse figure payment");
	}
	