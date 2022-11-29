
$(document).ready(function(){
	
	//Email Validation
	$(".email_validation").keyup(function(){	
		$(".email_validation").removeClass("is-invalid");
		//let regex = /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
		let regex = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/;
		
		let s = $(".email_validation").val();
		if (regex.test(s)) {
			$(".email_validation").removeClass("is-invalid");
			emailError = true;
		} else if(s==''){
			$(".email_validation").removeClass("is-invalid");
			emailError = false;
		} else {
			$(".email_validation").addClass("is-invalid");
			emailError = false;			
		}		
	});
    


    
	
	$(".name_validation").keyup(function(){	
		let regex = /^([a-zA-Z']+)$/;
		let s = $(".name_validation").val();
		if (regex.test(s)) {
			$(".name_validation").removeClass("is-invalid");
			emailError = true;
		} else if(s==''){
			$(".name_validation").removeClass("is-invalid");
			emailError = false;
		} else {
			$(".name_validation").addClass("is-invalid");
			emailError = false;			
		}		
	});	
	
	
	
});














/* 
//Field Validation (number minlength & maxlength)

onkeypress="return event.charCode >= 48 && event.charCode <= 57" //<input>

//(string with sapce)
onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)" //<input>



// Document is ready
$(document).ready(function () {
    // Validate Username
    $("#usercheck").hide();
    let usernameError = true;
    $("#usernames").keyup(function () {
        validateUsername();
    });
    
    function validateUsername() {
        let usernameValue = $("#usernames").val();
        if (usernameValue.length == "") {
        $("#usercheck").show();
        usernameError = false;
        return false;
        } else if (usernameValue.length < 3 || usernameValue.length > 10) {
        $("#usercheck").show();
        $("#usercheck").html("**length of username must be between 3 and 10");
        usernameError = false;
        return false;
        } else {
        $("#usercheck").hide();
        }
    }
    
	
    
    // Validate Password
    $("#passcheck").hide();
    let passwordError = true;
    $("#password").keyup(function () {
        validatePassword();
    });
    function validatePassword() {
        let passwordValue = $("#password").val();
        if (passwordValue.length == "") {
        $("#passcheck").show();
        passwordError = false;
        return false;
        }
        if (passwordValue.length < 3 || passwordValue.length > 10) {
        $("#passcheck").show();
        $("#passcheck").html(
            "**length of your password must be between 3 and 10"
        );
        $("#passcheck").css("color", "red");
        passwordError = false;
        return false;
        } else {
        $("#passcheck").hide();
        }
    }
    
    // Validate Confirm Password
    $("#conpasscheck").hide();
    let confirmPasswordError = true;
    $("#conpassword").keyup(function () {
        validateConfirmPassword();
    });
    function validateConfirmPassword() {
        let confirmPasswordValue = $("#conpassword").val();
        let passwordValue = $("#password").val();
        if (passwordValue != confirmPasswordValue) {
        $("#conpasscheck").show();
        $("#conpasscheck").html("**Password didn't Match");
        $("#conpasscheck").css("color", "red");
        confirmPasswordError = false;
        return false;
        } else {
        $("#conpasscheck").hide();
        }
    }
    
    // Submit button
    $("#submitbtn").click(function () {
        validateUsername();
        validatePassword();
        validateConfirmPassword();
        validateEmail();
        if (
        usernameError == true &&
        passwordError == true &&
        confirmPasswordError == true &&
        emailError == true
        ) {
        return true;
        } else {
        return false;
        }
    });
    });
    

    //Submit form
    $(document).ready(function(){
        $("#submitBtn").click(function(){        
            $("#myForm").submit(); // Submit the form
        });
    });





    //highlight(#->id, .->class)
    $(document).ready(function(){
        // Highlight element with id mark
        $("#mark").css("background", "yellow");
    });

    // highlight by attribute
    $(document).ready(function(){
        // Highlight paragraph elements
        $('input[type="text"]').css("background", "yellow");
    });

    //click to hide 
    $(document).ready(function(){
        $("p").click(function(){
            $(this).slideUp();
        });
    });


    //hover
    $(document).ready(function(){
        $("p").hover(function(){
            $(this).addClass("highlight");
        }, function(){
            $(this).removeClass("highlight");
        });
    });


    //toggle
    $(document).ready(function(){
        // Display alert message after toggling paragraphs
        $(".toggle-btn").click(function(){
            $("p").toggle(1000, function(){
                // Code to be executed
                alert("The toggle effect is completed.");
            });
        });
    }); */