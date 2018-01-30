function checkname(val1)
 {
		 var ster="^[A-z ]+$";
		 var regx=new RegExp(ster);
		 return regx.test(val1);
 }


function Proposal_Name()
{
	var val=document.getElementById("Project_Name").value;
	if(!checkname(val)){
	document.getElementById("Proposal_Name_Tooltip").style.display = 'block'; 
	document.getElementById("Project_Name").style.borderColor="rgba(250,66,74,1)";
	document.getElementById("Project_Name").className = "form-control form-control-danger";
	document.getElementById("Proposal_Name_Fieldset").className = "form-group has-danger";
	document.getElementById("submit").disabled=true;
	}
	else {
	document.getElementById("Proposal_Name_Tooltip").style.display = 'none'; 
	document.getElementById("Project_Name").style.borderColor="rgba(70,195,95,1)";
	document.getElementById("Project_Name").className = "form-control form-control-success";
	document.getElementById("Proposal_Name_Fieldset").className = "form-group has-success";
	document.getElementById("submit").disabled=false;
	}
}

function checkpid(val3)
 {
		 var ster="^[A-z]+$";
		 var regx=new RegExp(ster);
		 return regx.test(val3);
 }


function Proposal_Id()
{
	var val2=document.getElementById("Proposal_Id").value;
	if(!checkpid(val2)){
	document.getElementById("Proposal_Id_Tooltip").style.display = 'block'; 
	document.getElementById("Proposal_Id").style.borderColor="rgba(250,66,74,1)";
	document.getElementById("Proposal_Id").className = "form-control form-control-danger";
	document.getElementById("Copy_Proposal_Fieldset").className = "form-group has-danger";
	// document.getElementById("submit").disabled=true;
	}
	else {
	document.getElementById("Proposal_Id_Tooltip").style.display = 'none'; 
	document.getElementById("Proposal_Id").style.borderColor="rgba(70,195,95,1)";
	document.getElementById("Proposal_Id").className = "form-control form-control-success";
	document.getElementById("Copy_Proposal_Fieldset").className = "form-group has-success";
	// document.getElementById("submit").disabled=false;
	}
}