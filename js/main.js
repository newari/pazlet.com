$(document).ready(function(){
	activeStep=1;
})

function nextStep(stepNo){
	if(activeStep!=stepNo){
		$(".step"+activeStep).removeClass('activeStep');
		$(".step"+activeStep+" .step").addClass('hide');
		$(".step"+stepNo).addClass('activeStep');
		$(".step"+stepNo+" .step").removeClass('hide');
		activeStep=stepNo;
		if(activeStep==4){
			$(".step1").css('width', '13%');
		}else if(activeStep==2||activeStep==3){
			$(".step1").css('width', '10%');
		}else{
			$(".step1").css('width', '67%');
		}
	}
}

function showStep2(puzzleLink, pNo){
	$(".puzBox").css("background-image", "url('images/"+puzzleLink+"')");
	$(".step2 .step .ansBox").removeClass('hide');
	$(".step"+activeStep).removeClass('activeStep');
	$(".step"+activeStep+" .step").addClass('hide');
	$(".step2").addClass('activeStep');
	$(".step2 .step").removeClass('hide');
	selectedPuz=puzzleLink;
	activeStep=2;
	$(".step1").css('width', '10%');
	$("#pNo").val(pNo);

}

function showStep3(){
	puzAns=$("#puzAns").val();
	if(puzAns!=""&&puzAns!=" "){
		$(".step"+activeStep).removeClass('activeStep');
		$(".step"+activeStep+" .step").addClass('hide');
		$(".step3").addClass('activeStep');
		$(".step3 .step").removeClass('hide');
		activeStep=3;
	}else{
		showMsg("Please first give the answer of the puzzle!", 'warning', 5);
	}
		$(".step1").css('width', '10%');

}

function showStep4(){
	setedMoney=$("#setedMoney").val();
	if(setedMoney!=''&&setedMoney>4){
		$(".step"+activeStep).removeClass('activeStep');
		$(".step"+activeStep+" .step").addClass('hide');
		$(".step4").addClass('activeStep');
		$(".step4 .step").removeClass('hide');
		$(".step1").css('width', '13%');
		
		
		$("#puzAnsReview").val(puzAns);
		$("#setedMoneyReview").val(setedMoney);
		$("#pointsReview").val(setedMoney);
		activeStep=4;
	}else{
		showMsg("Please first Set the money greater than INR 4", 'warning', 5);
	}
}

function showLoginBox(){
	$(".login-box").removeClass("hide");
	$(".login-opt").addClass('hide');
}

function joinGame(){
	var gameId=$('#gameId').val();
	var pNo=$("#pNo").val();
	var ans=$("#puzAnsReview").val();
	var money=$("#setedMoneyReview").val();
	if(money>=5){
		$.ajax({
			url:'./scripts/join-game.php',
			type:'POST',
			data:{game_id:gameId, puzzle_no:pNo, puzzle_ans:ans, money:money},
			success:function(data){
				showMsg(data, "general", "5");
			}
		})
	}else{
		showMsg("Invested money must not be less then 5 tacs.", "warning", "5");
	}
}