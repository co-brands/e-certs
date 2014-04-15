$(function() {
		$("#accordion").accordion({
            heightStyle: "content",
            autoHeight: false,
            clearStyle: true,
        });
		$("#tabs").tabs();
		$("#sigPad").signaturePad();
	});	


function disableBtn()
	  { 
	  document.getElementById("add").disabled=true;
//	  window.alert("disabled because the function was called");
	  };
window.onload=disableBtn;
		
function undisableBtn()
	  {
	  document.getElementById("add").disabled=false;
//	  window.alert("undisabled because the function was called");
	  };

  function unPlusPay()
  {
//	  window.alert("start of unpluspay invoked");
	  undisableBtn();
	  figurePayment();
//	  window.alert("end of unpluspay");
  };

