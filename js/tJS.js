$(document).ready(function(){
	if(!$(".error-box").hasClass("hide")){
		setTimeout(function(){
			$(".error-box").slideUp();
		}, 5000);
	}
	base_slashes=3;
})
	base_slashes=3;

var activChartWindow="pieChart1";
function showMsg(msg, type, timeLimit){
	if(type=="info"){
		$(".error-box .container p").addClass('info-msg');
	}else if(type=="warning"){
		$(".error-box .container p").addClass('warning-msg');
	}else if(type=="success"){
		$(".error-box .container p").addClass('success-msg');
	}
	$(".error-box .container p").text(msg);
	$(".error-box").slideDown();
	if(timeLimit!=0){
		timeLimit=timeLimit*1000;
		setTimeout(function(){

			$(".error-box").slideUp();
		}, timeLimit);
	}

	
}

function showMsgModal(msg, type, timeLimit){
	if(type=="info"){
		$(".modal-error-box").addClass('info-msg');
	}else if(type=="warning"){
		$(".modal-error-box").addClass('warning-msg');
	}else if(type=="success"){
		$(".modal-error-box").addClass('success-msg');
	}
	$(".modal-error-box").text(msg);
	$(".modal-error-box").slideDown();
	if(timeLimit!=0){
		timeLimit=timeLimit*1000;
		setTimeout(function(){

			$(".modal-error-box").slideUp();
		}, timeLimit);
	}
	
}

function hideMsg(){
	$(".error-box").slideUp();
}

function hideMsgModal(){
	$(".modal-body .error-box").slideUp();
}

// Function.prototype.construct = function (aArgs) {
//     var fConstructor = this, fNewConstr = function () { fConstructor.apply(this, aArgs); };
//     fNewConstr.prototype = fConstructor.prototype;
//     return new fNewConstr();
// };
function goAjax(url, type, dataStr, isModal, successFunction){
	if(typeof isModal!=='undefined'&&isModal==true){
		showMsgModal("Processing...", 'general', 0);
	}else{
		showMsg("Processing...", 'general', 0);
	}
	dataArr=dataStr.split("|");
	
	var datas={};
	$.each(dataArr, function(varKey, varStr){
		var varArr=varStr.split(",");
		
		if(varArr[1][0]=='.'||varArr[1][0]=='#'){
			var dataVarVal=$(varArr[1]).val();
		}else{
			var dataVarVal=varArr[1];
		}

		datas[varArr[0]]=dataVarVal;
		
	})
	
	$.ajax({
		url:url,
		type:type,
		data:datas,
		success:function(data){
			console.log(data);
			if(typeof isModal!=='undefined'&&isModal==true){
				showMsgModal(data, 'info', 5);
			}else{
				showMsg(data, 'info', 5);
			}
			if(typeof successFunction!=='undefined'){
				successFunction(paras);
			}
		}
	})

	
}

