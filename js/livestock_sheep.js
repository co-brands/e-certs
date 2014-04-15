	function figurePayment()
	{
		if (document.getElementById('num_sheep_01').value) {var numSheep1 = document.getElementById('num_sheep_01').value;} else {var numSheep1 = 0;}
		if (document.getElementById('num_sheep_02').value) {var numSheep2 = document.getElementById('num_sheep_02').value;} else {var numSheep2 = 0;}
		if (document.getElementById('num_sheep_03').value) {var numSheep3 = document.getElementById('num_sheep_03').value;} else {var numSheep3 = 0;}
		if (document.getElementById('num_sheep_04').value) {var numSheep4 = document.getElementById('num_sheep_04').value;} else {var numSheep4 = 0;}
		if (document.getElementById('num_sheep_05').value) {var numSheep5 = document.getElementById('num_sheep_05').value;} else {var numSheep5 = 0;}
		if (document.getElementById('num_sheep_06').value) {var numSheep6 = document.getElementById('num_sheep_06').value;} else {var numSheep6 = 0;}
		if (document.getElementById('num_sheep_07').value) {var numSheep7 = document.getElementById('num_sheep_07').value;} else {var numSheep7 = 0;}
		if (document.getElementById('num_sheep_08').value) {var numSheep8 = document.getElementById('num_sheep_08').value;} else {var numSheep8 = 0;}
		if (document.getElementById('num_sheep_09').value) {var numSheep9 = document.getElementById('num_sheep_09').value;} else {var numSheep9 = 0;}
		if (document.getElementById('num_sheep_10').value) {var numSheep10 = document.getElementById('num_sheep_10').value;} else {var numSheep10 = 0;}
		
		var totalSheep = parseInt(numSheep1,10)+parseInt(numSheep2,10)+parseInt(numSheep3,10)+parseInt(numSheep4,10)+parseInt(numSheep5,10)+parseInt(numSheep6,10)+parseInt(numSheep7,10)+parseInt(numSheep8,10)+parseInt(numSheep9,10)+parseInt(numSheep10,10);
		document.getElementById('totalSheep').value = totalSheep;
		
		if (document.getElementById('remove_min_fee').checked) {} else {}
		if (document.getElementById('remove_svc_chg_fee').checked) {} else {}
		if (totalSheep < 1) {
			var minimumFee = 0;
		} else {
			var minimumFee = 15.00;
		}
		
		serviceChargeFee = (totalSheep*.40).toFixed(2);
		
		if (document.getElementById('remove_min_fee').checked) minimumFee = 0;
		if (document.getElementById('remove_svc_chg_fee').checked) serviceChargeFee = 0;
		
		document.getElementById('minimumFee').value = minimumFee.toFixed(2);
		document.getElementById('serviceChargeFee').value = serviceChargeFee;
		
		var totalDueFee = (parseInt(serviceChargeFee,10)+parseInt(minimumFee,10)).toFixed(2);
		document.getElementById('totalDueFee').value = totalDueFee;
	}