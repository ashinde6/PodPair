$(document).ready(function() {
    // Validate username
    function validateUsername() {
        var username = $('#username').val();
        if (username.length > 3) {
            $('#usernameError').hide();
            return true;
        } else {
            $('#usernameError').show();
            return false;
        }
    }

    // Validate password
    function validatePassword() {
        var password = $('#password').val();
        var pattern = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
        if (pattern.test(password)) {
            $('#passwordError').hide();
            return true;
        } else {
            $('#passwordError').show();
            return false;
        }
    }

    // Validate email
    function validateEmail() {
        var email = $('#email').val();
        var pattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (pattern.test(email)) {
            $('#emailError').hide();
            return true;
        } else {
            $('#emailError').show();
            return false;
        }
    }

    // Validate role selection
    function validateRole() {
        if ($('input[name="role"]:checked').length > 0) {
            $('#roleError').hide();
            return true;
        } else {
            $('#roleError').show();
            return false;
        }
    }

    // Close error message
    $('.close').click(function() {
        $(this).parent().hide();
    });

    // Bind validation to button click event
    $('#registerButton').click(function(e) {
        e.preventDefault(); // Prevent form submission
        e.stopImmediatePropagation(); 
        if (validateUsername() && validatePassword() && validateEmail() && validateRole()) {
            $('form').submit(); // Submit form if all validations pass
        }
    });

    // Bind validation to input events
    $('#username').keyup(validateUsername);
    $('#password').keyup(validatePassword);
    $('#email').keyup(validateEmail);
    $('input[name="role"]').change(validateRole);
});
