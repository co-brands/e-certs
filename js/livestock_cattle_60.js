function figurePayment()
	{
		if (document.getElementById('num_cattle_01').value) {var numcattle1 = document.getElementById('num_cattle_01').value;} else {var numcattle1 = 0;}
		if (document.getElementById('num_cattle_02').value) {var numcattle2 = document.getElementById('num_cattle_02').value;} else {var numcattle2 = 0;}
		if (document.getElementById('num_cattle_03').value) {var numcattle3 = document.getElementById('num_cattle_03').value;} else {var numcattle3 = 0;}
		if (document.getElementById('num_cattle_04').value) {var numcattle4 = document.getElementById('num_cattle_04').value;} else {var numcattle4 = 0;}
		if (document.getElementById('num_cattle_05').value) {var numcattle5 = document.getElementById('num_cattle_05').value;} else {var numcattle5 = 0;}
		if (document.getElementById('num_cattle_06').value) {var numcattle6 = document.getElementById('num_cattle_06').value;} else {var numcattle6 = 0;}
		if (document.getElementById('num_cattle_07').value) {var numcattle7 = document.getElementById('num_cattle_07').value;} else {var numcattle7 = 0;}
		if (document.getElementById('num_cattle_08').value) {var numcattle8 = document.getElementById('num_cattle_08').value;} else {var numcattle8 = 0;}
		if (document.getElementById('num_cattle_09').value) {var numcattle9 = document.getElementById('num_cattle_09').value;} else {var numcattle9 = 0;}
		if (document.getElementById('num_cattle_10').value) {var numcattle10 = document.getElementById('num_cattle_10').value;} else {var numcattle10 = 0;}
				
		var totalCattle = parseInt(numcattle1,10)+parseInt(numcattle2,10)+parseInt(numcattle3,10)+parseInt(numcattle4,10)+parseInt(numcattle5,10)
		+parseInt(numcattle6,10)+parseInt(numcattle7,10)+parseInt(numcattle8,10)+parseInt(numcattle9,10)+parseInt(numcattle10,10);
				document.getElementById('totalCattle').value = totalCattle;

		if (document.getElementById('remove_ten_only').checked) {} else {}
//				if this is clicked, it removes every fee but a $10 service charge		
		if (document.getElementById('remove_min_fee').checked) {} else {}
		if (document.getElementById('remove_svc_chg_fee').checked) {} else {}
		
		if (totalCattle < 1) {
			var minimumFee = 0;
		} else {
			var minimumFee = 10.00;
		}
		
		serviceChargeFee  = (totalCattle*.55).toFixed(2);
		beefCouncilFee = (totalCattle*1).toFixed(2);
		
		if (document.getElementById('remove_ten_only').checked) minimumFee = 0;
//		this has to be determined how to do it TODO
		if (document.getElementById('remove_min_fee').checked) minimumFee = 0;
		if (document.getElementById('remove_svc_chg_fee').checked) serviceChargeFee = 0;
		
		document.getElementById('minimumFee').value = minimumFee.toFixed(2);
		document.getElementById('serviceChargeFee').value = serviceChargeFee;
		document.getElementById('beefCouncilFee').value = beefCouncilFee;
		
		var totalDueFee = (parseInt(serviceChargeFee,10)+parseInt(minimumFee,10)+parseInt(beefCouncilFee,10)).toFixed(2);
		document.getElementById('totalDueFee').value = totalDueFee;
	}