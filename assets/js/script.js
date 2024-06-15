$(document).ready(() => {

	// Modal - Adicionar Usuário
	$('.members .add-user').click(function() {
		$('.overlay-modal-register').show()
	})

	$('.members .close-btn').click(function() {
        $('.overlay-modal-register').hide()
		$('.modal-register .types').show()
		$('.modal-register .form-register').hide()
    })

	$('.overlay-modal-register').click(function(event) {
		if (event.target === this) {
			$(this).hide()
			$('.modal-register .types').show()
			$('.modal-register .form-register').hide()
		}
	})	

	$('.modal-register .types button').click(function() {
        $('.modal-register .types').hide()
        $('.modal-register .form-register[data-role="' + $(this).data('role') + '"]').show()
    })

	// Toggle nas options do card do usuário
	$('.options-btn').click(function(event) {
        event.stopPropagation()
        $('.options-card').not($(this).siblings('.options-card')).hide()
        $(this).siblings('.options-card').toggle()
    })

    $(document).click(function(event) {
        if (!$(event.target).closest('.options-btn, .options-card').length) {
            $('.options-card').hide()
        }
    })

	// Sidebar - Link selected
	$('.sidebar .links a[data-page="' + $('section:first').data('page')  + '"]').addClass('selected')

	// Mostrar senha
	$('.hide-show').click(function() {
		let input = $(this).closest('.input').find('input');
    
		if (input.attr('type') === 'password') {
			input.attr('type', 'text')
			$(this).find('.eye-hide').hide()
			$(this).find('.eye-show').show()
		} else {
			input.attr('type', 'password')
			$(this).find('.eye-hide').show()
			$(this).find('.eye-show').hide()
		}
	})
    
	// Cadastro de Funcionários - Validação
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

	// Cadastro de Alunos - Validação
	$('#register-student .submit button').click(function() {

		// Valida nome
		let nameValid = false;
		if($('#register-student span[data-input="name"] input').val().length >= 1) {
			$('#register-student span[data-input="name"] .invalid-text').addClass('none')
			$('#register-student span[data-input="name"] .input').removeClass('invalid-input')
			nameValid = true;
		} else {
			$('#register-student span[data-input="name"] .invalid-text').removeClass('none')
			$('#register-student span[data-input="name"] .input').addClass('invalid-input')
			nameValid = false;
		}

		// Valida email
		let emailValid = false;
		const regexEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,10}$/;
		if (regexEmail.test($('#register-student span[data-input="email"] input').val())) {
			$('#register-student span[data-input="email"] .invalid-text').addClass('none')
			$('#register-student span[data-input="email"] .input').removeClass('invalid-input')
			emailValid = true;
		} else {
			$('#register-student span[data-input="email"] .invalid-text').removeClass('none')
			$('#register-student span[data-input="email"] .input').addClass('invalid-input')
			emailValid = false;
		}

		// Valida telefone
		let phoneValid = false;
		if($('#register-student span[data-input="phone"] input').val().length >= 14) {
			$('#register-student span[data-input="phone"] .invalid-text').addClass('none')
			$('#register-student span[data-input="phone"] .input').removeClass('invalid-input')
			phoneValid = true;
		} else {
			$('#register-student span[data-input="phone"] .invalid-text').removeClass('none')
			$('#register-student span[data-input="phone"] .input').addClass('invalid-input')
			phoneValid = false;
		}

		// Valida número da matrícula
		let registrationNumberValid = false;
		if($('#register-student span[data-input="registration-number"] input').val().length >= 1) {
			$('#register-student span[data-input="registration-number"] .invalid-text').addClass('none')
			$('#register-student span[data-input="registration-number"] .input').removeClass('invalid-input')
			registrationNumberValid = true;
		} else {
			$('#register-student span[data-input="registration-number"] .invalid-text').removeClass('none')
			$('#register-student span[data-input="registration-number"] .input').addClass('invalid-input')
			registrationNumberValid = false;
		}

		// Valida curso
		let courseValid = false;
		if($('#register-student span[data-input="course"] input').val().length >= 1) {
			$('#register-student span[data-input="course"] .invalid-text').addClass('none')
			$('#register-student span[data-input="course"] .input').removeClass('invalid-input')
			courseValid = true;
		} else {
			$('#register-student span[data-input="course"] .invalid-text').removeClass('none')
			$('#register-student span[data-input="course"] .input').addClass('invalid-input')
			courseValid = false;
		}

		// Valida série/ano
		let yearValid = false;
		if($('#register-student span[data-input="year"] input').val().length >= 1) {
			$('#register-student span[data-input="year"] .invalid-text').addClass('none')
			$('#register-student span[data-input="year"] .input').removeClass('invalid-input')
			yearValid = true;
		} else {
			$('#register-student span[data-input="year"] .invalid-text').removeClass('none')
			$('#register-student span[data-input="year"] .input').addClass('invalid-input')
			yearValid = false;
		}

		// Valida instituição
		let institutionValid = false;
		if($('#register-student span[data-input="institution"] input').val().length >= 1) {
			$('#register-student span[data-input="institution"] .invalid-text').addClass('none')
			$('#register-student span[data-input="institution"] .input').removeClass('invalid-input')
			institutionValid = true;
		} else {
			$('#register-student span[data-input="institution"] .invalid-text').removeClass('none')
			$('#register-student span[data-input="institution"] .input').addClass('invalid-input')
			institutionValid = false;
		}

		// Valida horas a validar
		let hoursToBeValidatedValid = false;
		if($('#register-student span[data-input="hours-to-be-validated"] input').val().length >= 1) {
			$('#register-student span[data-input="hours-to-be-validated"] .invalid-text').addClass('none')
			$('#register-student span[data-input="hours-to-be-validated"] .input').removeClass('invalid-input')
			hoursToBeValidatedValid = true;
		} else {
			$('#register-student span[data-input="hours-to-be-validated"] .invalid-text').removeClass('none')
			$('#register-student span[data-input="hours-to-be-validated"] .input').addClass('invalid-input')
			hoursToBeValidatedValid = false;
		}

		// Valida senha
		let passwordValid = false;
		if($('#register-student span[data-input="password"] input').val().length >= 8) {
			$('#register-student span[data-input="password"] .invalid-text').addClass('none')
			$('#register-student span[data-input="password"] .input').removeClass('invalid-input')
			passwordValid = true;
		} else {
			$('#register-student span[data-input="password"] .invalid-text').removeClass('none')
			$('#register-student span[data-input="password"] .input').addClass('invalid-input')
			passwordValid = false;
		}

		// Valida confirmar senha
		let confirmPasswordValid = false;
		if($('#register-student span[data-input="confirm-password"] input').val() == $('#register-student span[data-input="password"] input').val()) {
			$('#register-student span[data-input="confirm-password"] .invalid-text').addClass('none')
			$('#register-student span[data-input="confirm-password"] .input').removeClass('invalid-input')
			confirmPasswordValid = true;
		} else {
			$('#register-student span[data-input="confirm-password"] .invalid-text').removeClass('none')
			$('#register-student span[data-input="confirm-password"] .input').addClass('invalid-input')
			confirmPasswordValid = false;
		}

		if(nameValid &&
		emailValid &&
		phoneValid &&
		registrationNumberValid &&
		courseValid &&
		yearValid &&
		institutionValid &&
		hoursToBeValidatedValid &&
		passwordValid &&
		confirmPasswordValid) {
			$('#register-student .submit button').prop('type', 'submit')
		} else {
			$('#register-student .submit button').prop('type', 'button')
		}

	})

	// Masks
	$('.mask-phone').mask('(00) 0000-0000')
	$('.mask-cel').mask('(00) 0 0000-0000')

})