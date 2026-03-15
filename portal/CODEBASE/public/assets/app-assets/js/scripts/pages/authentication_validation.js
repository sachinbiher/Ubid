
$(function () {
    'use strict';
  
    var pageForgotPasswordForm = $('.auth-forgot-password-form');
    if (pageForgotPasswordForm.length) {
      pageForgotPasswordForm.validate({
         
    
      onkeyup: function (element) {
        $(element).valid();
      },
     
    
      onfocusout: function (element) {
        $(element).valid();
      }, 
        rules: {
          'forgot-password-email': {
            required: true,
            email: true
          }
        },
        
      });
      
    }
    var pageResetPasswordForm = $('.auth-reset-password-form');

    // jQuery Validation
    // --------------------------------------------------------------------
    if (pageResetPasswordForm.length) {
      pageResetPasswordForm.validate({
        rules: {
          'reset-password-new': {
            required: true
          },
          'reset-password-old': {
            required: true
          },
          'reset-password-confirm': {
            required: true,
            equalTo: '#reset-password-new'
          }
        }
      });
    }
    var pageLoginForm = $('.auth-login-form');

    // jQuery Validation
    // --------------------------------------------------------------------
    if (pageLoginForm.length) {
      pageLoginForm.validate({
      
        rules: {
          'email': {
            required: true,
            email: true
          },
          'password': {
            required: true
          }
        }
      });
    }
    var e = $(".auth-register-form");
    e.length && e.validate({
        rules: {
            "register-username": {
                required: !0
            },
            "register-email": {
                required: !0,
                email: !0
            },
             "register-mobile": {
                required: !0
              
            },
            "register-password": {
                required: !0
            },
            "register-confirmpassword": {
                required: !0,
                equalTo: '#register-password'
            }
        }
    })

    var pageForgotPasswordForm = $('.auth-forgot-password-form');
  if (pageForgotPasswordForm.length) {
    pageForgotPasswordForm.validate({
    
      rules: {
        'forgot-password-email': {
          required: true,
          email: true
        }
      }
    });
  }
  });
  