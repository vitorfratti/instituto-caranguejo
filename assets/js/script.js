$(document).ready(() => {

	$('form').submit(function(event) {
        $('.overlay-loading').show()
    })

	// Edição de Projetos - Validação
	$('#edit-project .submit button').click(function() {

		// Valida nome
		let nameValid = false;
		if($('#edit-project span[data-input="project-name"] input').val().length >= 1) {
			$('#edit-project span[data-input="project-name"] .invalid-text').addClass('none')
			$('#edit-project span[data-input="project-name"] .input').removeClass('invalid-input')
			nameValid = true;
		} else {
			$('#edit-project span[data-input="project-name"] .invalid-text').removeClass('none')
			$('#edit-project span[data-input="project-name"] .input').addClass('invalid-input')
			nameValid = false;
		}

		// Valida descrição
		let descriptionValid = false;
		if($('#edit-project span[data-input="project-description"] textarea').val().length >= 1) {
			$('#edit-project span[data-input="project-description"] .invalid-text').addClass('none')
			$('#edit-project span[data-input="project-description"] .input').removeClass('invalid-input')
			descriptionValid = true;
		} else {
			$('#edit-project span[data-input="project-description"] .invalid-text').removeClass('none')
			$('#edit-project span[data-input="project-description"] .input').addClass('invalid-input')
			descriptionValid = false;
		}

		if(nameValid && descriptionValid) {
			$('#edit-project .submit button').prop('type', 'submit')
		} else {
			$('#edit-project .submit button').prop('type', 'button')
		}

	})

	// Acões do Modal - Editar Projeto
	$('.projects .edit-project-btn').click(function() {
		$('.overlay-modal-edit-project').show()
	})

	$('.projects .modal-edit-project .close-btn').click(function() {
        $('.overlay-modal-edit-project').hide()
		$('.options-card').hide()
    })

	$('.overlay-modal-edit-project').click(function(event) {
		if (event.target === this) {
			$(this).hide()
			$('.options-card').hide()
		}
	})

	// Edição de Atividades - Validação
	$('#edit-activity .submit button').click(function() {

		// Valida nome
		let nameValid = false;
		if($('#edit-activity span[data-input="activity-name"] input').val().length >= 1) {
			$('#edit-activity span[data-input="activity-name"] .invalid-text').addClass('none')
			$('#edit-activity span[data-input="activity-name"] .input').removeClass('invalid-input')
			nameValid = true;
		} else {
			$('#edit-activity span[data-input="activity-name"] .invalid-text').removeClass('none')
			$('#edit-activity span[data-input="activity-name"] .input').addClass('invalid-input')
			nameValid = false;
		}

		if(nameValid) {
			$('#edit-activity .submit button').prop('type', 'submit')
		} else {
			$('#edit-activity .submit button').prop('type', 'button')
		}

	})

	// Acões do Modal - Editar Atividade
	$('.project-single .edit-activity-btn').click(function() {
		$('.overlay-modal-edit-activity').show()
	})

	$('.project-single .modal-edit-activity .close-btn').click(function() {
        $('.overlay-modal-edit-activity').hide()
		$('.options-card').hide()
    })

	$('.overlay-modal-edit-activity').click(function(event) {
		if (event.target === this) {
			$(this).hide()
			$('.options-card').hide()
		}
	})

	// Acões do Modal - Inserir notas da atividade
	$('.activity-single .score-btn').click(function() {
		$(this).closest('.score').find('.score-card').toggle()
		$(this).find('img').toggleClass('rotate')
	})

	$(document).click(function(event) {
		if (!$(event.target).closest('.score-card, .score-btn').length) {
			$('.score-card').hide()
			$('.score-btn img').removeClass('rotate')
		}
	})

	// Confirmar remoção do aluno na atividade
	$('#remove-user-from-activity button').click(function() {
		if (confirm('Tem certeza que deseja remover este aluno da atividade?')) {
			$(this).closest('form').submit()
		}
	})

	// Url atual para redirecionamento das ações - Atividades
	$('.activity-single input[name="current-activity-url"]').val(window.location.href)

	// Selecionando usuários na atividade
	let selectedUsers = []

    function updateTextarea() {
        $('#students-ids').val(selectedUsers.join(', '))
    }

    function addStudentCard(userId, userName) {
        let cardHtml = `
            <div class="card" data-student-id="${userId}">
                ${userName}
                <button type="button" class="remove-student">
					<svg width="64px" height="64px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<g id="SVGRepo_bgCarrier" stroke-width="0"/>
						<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
						<g id="SVGRepo_iconCarrier"> <g id="Menu / Close_MD"> <path id="Vector" d="M18 18L12 12M12 12L6 6M12 12L18 6M12 12L6 18" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/> </g> </g>
					</svg>
                </button>
            </div>`;
        $('#selected-students').append(cardHtml)
    }

    $('#students-input').on('input', function() {
        let inputValue = $(this).val()
        let option = $('#students-list option').filter(function() {
            return $(this).val() === inputValue
        })
        
        if (option.length) {
            let userId = option.data('id')
            let userName = option.val()

            if (!selectedUsers.includes(userId)) {
                selectedUsers.push(userId)
                addStudentCard(userId, userName)
                updateTextarea()
            }

            $(this).val('')
        }
    });

    $('#selected-students').on('click', '.remove-student', function() {
        let card = $(this).closest('.card')
        let userId = card.data('student-id')

        selectedUsers = selectedUsers.filter(id => id !== userId)
        card.remove()
        updateTextarea()
    })

    $('#add-student-button').on('click', function() {
        if (selectedUsers.length === 0) {
            $('.invalid-text').removeClass('none')
        } else {
            $('.invalid-text').addClass('none')
            $('#add-student-activity').submit()
        }
    })

	// Acões do Modal - Adionar alunos na atividade
	$('.activity-single .add-student-activity').click(function() {
		$('.overlay-modal-add-student-activity').show()
	})

	$('.activity-single .modal-add-student-activity .close-btn').click(function() {
        $('.overlay-modal-add-student-activity').hide()
    })

	$('.overlay-modal-add-student-activity').click(function(event) {
		if (event.target === this) {
			$(this).hide()
		}
	})

	// Confirmar remoção da atividade
	$('#delete-activity button').click(function() {
		if (confirm('Tem certeza que deseja remover esta atividade?')) {
			$(this).closest('form').submit()
		}
	})

	// Url atual para redirecionamento das ações - Atividades
	$('.project-single input[name="current-project-url"]').val(window.location.href)

	// Data atual no input de data - Cadastro de Atividades
	$('.project-single input[name="activity-date"]').val(new Date().toISOString().split('T')[0])

	// Cadastro de Atividades - Validação
	$('#create-activity .submit button').click(function() {

		// Valida nome
		let nameValid = false;
		if($('#create-activity span[data-input="activity-name"] input').val().length >= 1) {
			$('#create-activity span[data-input="activity-name"] .invalid-text').addClass('none')
			$('#create-activity span[data-input="activity-name"] .input').removeClass('invalid-input')
			nameValid = true;
		} else {
			$('#create-activity span[data-input="activity-name"] .invalid-text').removeClass('none')
			$('#create-activity span[data-input="activity-name"] .input').addClass('invalid-input')
			nameValid = false;
		}

		if(nameValid) {
			$('#create-activity .submit button').prop('type', 'submit')
		} else {
			$('#create-activity .submit button').prop('type', 'button')
		}

	})

	// Acões do Modal - Criar Atividade
	$('.project-single .create-activity').click(function() {
		$('.overlay-modal-create-activity').show()
	})

	$('.project-single .modal-create-activity .close-btn').click(function() {
        $('.overlay-modal-create-activity').hide()
    })

	$('.overlay-modal-create-activity').click(function(event) {
		if (event.target === this) {
			$(this).hide()
		}
	})

	// Confirmar remoção de projeto
	$('#delete-project button').click(function() {
		if (confirm('Tem certeza que deseja remover este projeto?')) {
			$(this).closest('form').submit()
		}
	})

	// Confirmar remoção de usuário
	$('#delete-user button').click(function() {
		if (confirm('Tem certeza que deseja remover este usuário?')) {
			$(this).closest('form').submit()
		}
	})

	// Data atual no input de data - Cadastro de Projetos
	$('.projects input[name="project-date"]').val(new Date().toISOString().split('T')[0])

	// Cadastro de Projetos - Validação
	$('#create-project .submit button').click(function() {

		// Valida nome
		let nameValid = false;
		if($('#create-project span[data-input="project-name"] input').val().length >= 1) {
			$('#create-project span[data-input="project-name"] .invalid-text').addClass('none')
			$('#create-project span[data-input="project-name"] .input').removeClass('invalid-input')
			nameValid = true;
		} else {
			$('#create-project span[data-input="project-name"] .invalid-text').removeClass('none')
			$('#create-project span[data-input="project-name"] .input').addClass('invalid-input')
			nameValid = false;
		}

		// Valida descrição
		let descriptionValid = false;
		if($('#create-project span[data-input="project-description"] textarea').val().length >= 1) {
			$('#create-project span[data-input="project-description"] .invalid-text').addClass('none')
			$('#create-project span[data-input="project-description"] .input').removeClass('invalid-input')
			descriptionValid = true;
		} else {
			$('#create-project span[data-input="project-description"] .invalid-text').removeClass('none')
			$('#create-project span[data-input="project-description"] .input').addClass('invalid-input')
			descriptionValid = false;
		}

		if(nameValid && descriptionValid) {
			$('#create-project .submit button').prop('type', 'submit')
		} else {
			$('#create-project .submit button').prop('type', 'button')
		}

	})

	// Acões do Modal - Criar Projeto
	$('.projects .create-project').click(function() {
		$('.overlay-modal-create-project').show()
	})

	$('.projects .modal-create-project .close-btn').click(function() {
        $('.overlay-modal-create-project').hide()
    })

	$('.overlay-modal-create-project').click(function(event) {
		if (event.target === this) {
			$(this).hide()
		}
	})	

	// Verificação - Formulário de editar usuário 
	function checkSettingsFields() {
		let checked = 0
		let total = $('.settings #edit-user .settings-field').length
	
		$('.settings #edit-user .settings-field').each(function() {
			if($(this).val() === $(this).data('value')) {
				checked++
			}
		})

		if(checked == total) {
			$('.settings #edit-user .submit').prop('disabled', true)
			$('.settings #edit-user .submit').addClass('disabled')
			$('.settings #edit-user .cancel').hide()
		} else {
			$('.settings #edit-user .submit').prop('disabled', false)
			$('.settings #edit-user .submit').removeClass('disabled')
			$('.settings #edit-user .cancel').show()
		}
	}

	checkSettingsFields()

	$('.settings #edit-user .settings-field').on('input', checkSettingsFields)

	$('.settings form .cancel').click(function() {
		$('.settings form input').each(function() {
			$(this).val($(this).data('value'))
		})
		checkSettingsFields()
	})

	// Acões do Modal - Adicionar Usuário
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

	// Toggle nas options do card
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

	// Hide Loading
    $('.overlay-loading').hide()

	// Masks
	$('.mask-phone').mask('(00) 0000-0000')
	$('.mask-cel').mask('(00) 0 0000-0000')

})