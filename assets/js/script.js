$(document).ready(() => {
    
    $('#register-employees .submit button').click(function() {

        // Valida nome
		let nameValid = false;
		if($('#register-employees span[data-input="name"] input').val().length >= 1) {
			$('#register-employees span[data-input="name"] .invalid-text').addClass('none')
			$('#register-employees span[data-input="name"] .input').removeClass('invalid-input')
			nameValid = true;
		} else {
			$('#register-employees span[data-input="name"] .invalid-text').removeClass('none')
			$('#register-employees span[data-input="name"] .input').addClass('invalid-input')
			nameValid = false;
		}

        // Valida email
		let emailValid = false;
		const regexEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,10}$/;
		if (regexEmail.test($('#register-employees span[data-input="email"] input').val())) {
			$('#register-employees span[data-input="email"] .invalid-text').addClass('none')
			$('#register-employees span[data-input="email"] .input').removeClass('invalid-input')
			emailValid = true;
		} else {
			$('#register-employees span[data-input="email"] .invalid-text').removeClass('none')
			$('#register-employees span[data-input="email"] .input').addClass('invalid-input')
			emailValid = false;
		}

        // Valida senha
		let passwordValid = false;
		if($('#register-employees span[data-input="password"] input').val().length >= 8) {
            $('#register-employees span[data-input="password"] .invalid-text').addClass('none')
			$('#register-employees span[data-input="password"] .input').removeClass('invalid-input')
			passwordValid = true;
		} else {
			$('#register-employees span[data-input="password"] .invalid-text').removeClass('none')
			$('#register-employees span[data-input="password"] .input').addClass('invalid-input')
			passwordValid = false;
		}

        // Valida confirmar senha
		let confirmPasswordValid = false;
		if($('#register-employees span[data-input="confirm-password"] input').val() == $('#register-employees span[data-input="password"] input').val()) {
            $('#register-employees span[data-input="confirm-password"] .invalid-text').addClass('none')
			$('#register-employees span[data-input="confirm-password"] .input').removeClass('invalid-input')
			confirmPasswordValid = true;
		} else {
			$('#register-employees span[data-input="confirm-password"] .invalid-text').removeClass('none')
			$('#register-employees span[data-input="confirm-password"] .input').addClass('invalid-input')
			confirmPasswordValid = false;
		}

        if(nameValid && emailValid && passwordValid && confirmPasswordValid) {
            $('#register-employees .submit button').prop('type', 'submit')
        } else {
            $('#register-employees .submit button').prop('type', 'button')
        }

    })

})