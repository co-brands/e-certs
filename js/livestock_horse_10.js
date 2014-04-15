function figurePayment()
	{
//	window.alert("start of horse figure payment");
		if (document.getElementById('num_horse_country_01').value) {var numHorse1 = document.getElementById('num_horse_country_01').value;} else {var numHorse1 = 0;}
		if (document.getElementById('num_horse_country_02').value) {var numHorse2 = document.getElementById('num_horse_country_02').value;} else {var numHorse2 = 0;}
		if (document.getElementById('num_horse_country_03').value) {var numHorse3 = document.getElementById('num_horse_country_03').value;} else {var numHorse3 = 0;}
		if (document.getElementById('num_horse_country_04').value) {var numHorse4 = document.getElementById('num_horse_country_04').value;} else {var numHorse4 = 0;}
		if (document.getElementById('num_horse_country_05').value) {var numHorse5 = document.getElementById('num_horse_country_05').value;} else {var numHorse5 = 0;}
		if (document.getElementById('num_horse_country_06').value) {var numHorse6 = document.getElementById('num_horse_country_06').value;} else {var numHorse6 = 0;}
		if (document.getElementById('num_horse_country_07').value) {var numHorse7 = document.getElementById('num_horse_country_07').value;} else {var numHorse7 = 0;}
		if (document.getElementById('num_horse_country_08').value) {var numHorse8 = document.getElementById('num_horse_country_08').value;} else {var numHorse8 = 0;}
		if (document.getElementById('num_horse_country_09').value) {var numHorse9 = document.getElementById('num_horse_country_09').value;} else {var numHorse9 = 0;}
		if (document.getElementById('num_horse_country_10').value) {var numHorse10 = document.getElementById('num_horse_country_10').value;} else {var numHorse10 = 0;}
		if (document.getElementById('num_horse_permit_01').value) {var numHorse21 = document.getElementById('num_horse_permit_01').value;} else {var numHorse11 = 0;}
		if (document.getElementById('num_horse_permit_02').value) {var numHorse22 = document.getElementById('num_horse_permit_02').value;} else {var numHorse12 = 0;}
		if (document.getElementById('num_horse_permit_03').value) {var numHorse23 = document.getElementById('num_horse_permit_03').value;} else {var numHorse13 = 0;}
		if (document.getElementById('num_horse_permit_04').value) {var numHorse24 = document.getElementById('num_horse_permit_04').value;} else {var numHorse14 = 0;}
		if (document.getElementById('num_horse_permit_05').value) {var numHorse25 = document.getElementById('num_horse_permit_05').value;} else {var numHorse15 = 0;}
		if (document.getElementById('num_horse_permit_06').value) {var numHorse26 = document.getElementById('num_horse_permit_06').value;} else {var numHorse16 = 0;}
		if (document.getElementById('num_horse_permit_07').value) {var numHorse27 = document.getElementById('num_horse_permit_07').value;} else {var numHorse17 = 0;}
		if (document.getElementById('num_horse_permit_08').value) {var numHorse28 = document.getElementById('num_horse_permit_08').value;} else {var numHorse18 = 0;}
		if (document.getElementById('num_horse_permit_09').value) {var numHorse29 = document.getElementById('num_horse_permit_09').value;} else {var numHorse19 = 0;}
		if (document.getElementById('num_horse_permit_10').value) {var numHorse30 = document.getElementById('num_horse_permit_10').value;} else {var numHorse20 = 0;}
		
		var totalHorse = parseInt(numHorse1,20)+parseInt(numHorse2,20)+parseInt(numHorse3,20)+parseInt(numHorse4,20)+parseInt(numHorse5,20)
		+parseInt(numHorse6,20)+parseInt(numHorse7,20)+parseInt(numHorse8,20)+parseInt(numHorse9,20)+parseInt(numHorse10,20)
		+parseInt(numHorse11,20)+parseInt(numHorse12,20)+parseInt(numHorse13,20)+parseInt(numHorse14,20)+parseInt(numHorse15,20)
		+parseInt(numHorse16,20)+parseInt(numHorse17,20)+parseInt(numHorse18,20)+parseInt(numHorse19,20)+parseInt(numHorse20,20);
				document.getElementById('totalHorse').value = totalHorse;

		var totalCountryHorse = parseInt(numHorse1,20)+parseInt(numHorse2,20)+parseInt(numHorse3,20)+parseInt(numHorse4,20)+parseInt(numHorse5,20)
		+parseInt(numHorse6,20)+parseInt(numHorse7,20)+parseInt(numHorse8,20)+parseInt(numHorse9,20)+parseInt(numHorse10,20);
				document.getElementById('totalCountryHorse').value = totalCountryHorse;

		var totalPermitHorse = parseInt(numHorse11,20)+parseInt(numHorse12,20)+parseInt(numHorse13,20)+parseInt(numHorse14,20)+parseInt(numHorse15,20)
		+parseInt(numHorse16,20)+parseInt(numHorse17,20)+parseInt(numHorse18,20)+parseInt(numHorse19,20)+parseInt(numHorse20,20);
				document.getElementById('totalPermitHorse').value = totalPermitHorse;

		var negHBFee01 = parseInt(numHorse1,20)+parseInt(numHorse11,20);
		document.getElementById('negHBFee01').value = negHBFee01;
		var negHBFee02 = parseInt(numHorse2,20)+parseInt(numHorse12,20);
		document.getElementById('negHBFee02').value = negHBFee02;
		var negHBFee03 = parseInt(numHorse3,20)+parseInt(numHorse13,20);
		document.getElementById('negHBFee03').value = negHBFee03;
		var negHBFee04 = parseInt(numHorse4,20)+parseInt(numHorse14,20);
		document.getElementById('negHBFee04').value = negHBFee04;
		var negHBFee05 = parseInt(numHorse5,20)+parseInt(numHorse15,20);
		document.getElementById('negHBFee05').value = negHBFee05;
		var negHBFee06 = parseInt(numHorse6,20)+parseInt(numHorse16,20);
		document.getElementById('negHBFee06').value = negHBFee06;
		var negHBFee07 = parseInt(numHorse7,20)+parseInt(numHorse17,20);
		document.getElementById('negHBFee07').value = negHBFee07;
		var negHBFee08 = parseInt(numHorse8,20)+parseInt(numHorse18,20);
		document.getElementById('negHBFee08').value = negHBFee08;
		var negHBFee09 = parseInt(numHorse9,20)+parseInt(numHorse19,20);
		document.getElementById('negHBFee09').value = negHBFee09;
		var negHBFee10 = parseInt(numHorse10,20)+parseInt(numHorse20,20);
		document.getElementById('negHBFee10').value = negHBFee10;
		
		if (document.getElementById('remove_ten_only').checked) {} else {}
//		if this is clicked, it removes every fee but a $10 service charge
		if (document.getElementById('remove_min_fee').checked) {} else {}
		if (document.getElementById('remove_svc_chg_fee').checked) {} else {}
		if (document.getElementById('horse_movement_01').checked) {} else {}
		if (document.getElementById('horse_movement_02').checked) {} else {}
		if (document.getElementById('horse_movement_03').checked) {} else {}
		if (document.getElementById('horse_movement_04').checked) {} else {}
		if (document.getElementById('horse_movement_05').checked) {} else {}
		if (document.getElementById('horse_movement_06').checked) {} else {}
		if (document.getElementById('horse_movement_07').checked) {} else {}
		if (document.getElementById('horse_movement_08').checked) {} else {}
		if (document.getElementById('horse_movement_09').checked) {} else {}
		if (document.getElementById('horse_movement_10').checked) {} else {}
		if (totalHorse < 1) {
			var minimumFee = 0;
		} else {
			var minimumFee = 15.00;
		}
		
		serviceChargeCountryFee = (totalCountryHorse*1).toFixed(2);
		serviceChargePLMFee = (totalPLMHorse*2).toFixed(2);
		serviceChargePermitFee = (totalPermitHorse*25).toFixed(2);
		
		serviceNEGHorseBoardFee01 = (negHBFee01*(-3)).toFixed(2);
		serviceNEGHorseBoardFee02 = (negHBFee02*(-3)).toFixed(2);
		serviceNEGHorseBoardFee03 = (negHBFee03*(-3)).toFixed(2);
		serviceNEGHorseBoardFee04 = (negHBFee04*(-3)).toFixed(2);
		serviceNEGHorseBoardFee05 = (negHBFee05*(-3)).toFixed(2);
		serviceNEGHorseBoardFee06 = (negHBFee06*(-3)).toFixed(2);
		serviceNEGHorseBoardFee07 = (negHBFee07*(-3)).toFixed(2);
		serviceNEGHorseBoardFee08 = (negHBFee08*(-3)).toFixed(2);
		serviceNEGHorseBoardFee09 = (negHBFee09*(-3)).toFixed(2);
		serviceNEGHorseBoardFee10 = (negHBFee10*(-3)).toFixed(2);
		
		servicePOSHorseBoardFee = (totalHorse*3).toFixed(2);

		var serviceHorseBoardFee = (parseInt(servicePOSHorseBoardFee,20)+parseInt(serviceNEGHorseBoardFee01,20)
				+parseInt(serviceNEGHorseBoardFee02,20)+parseInt(serviceNEGHorseBoardFee03,20)
				+parseInt(serviceNEGHorseBoardFee04,20)+parseInt(serviceNEGHorseBoardFee05,20)
				+parseInt(serviceNEGHorseBoardFee06,20)+parseInt(serviceNEGHorseBoardFee07,20)
				+parseInt(serviceNEGHorseBoardFee08,20)+parseInt(serviceNEGHorseBoardFee09,20)
				+parseInt(serviceNEGHorseBoardFee10,20)).toFixed(2);
		document.getElementById('serviceHorseBoardFee').value = serviceHorseBoardFee;
		
		var serviceChargeFee = (parseInt(serviceChargeCountryFee,20)+parseInt(serviceChargePermitFee,20)+parseInt(serviceHorseBoardFee,20)).toFixed(2);
		document.getElementById('serviceChargeFee').value = serviceChargeFee;
		
		if (document.getElementById('remove_ten_only').checked) minimumFee = 0;
//		this has to be determined how to do it TODO
		if (document.getElementById('remove_min_fee').checked) minimumFee = 0;
		if (document.getElementById('remove_svc_chg_fee').checked) serviceChargeFee = 0;
		
		document.getElementById('minimumFee').value = minimumFee.toFixed(2);
//		document.getElementById('serviceChargeFee').value = serviceChargeFee;
		
		var totalDueFee = (parseInt(serviceChargeFee,20)+parseInt(minimumFee,20)).toFixed(2);
		document.getElementById('totalDueFee').value = totalDueFee;
//		window.alert("end of horse figure payment");
	}
	