(function(window, undefined) {
    'use strict';
    $(".card-option .minimize-card").on("click", function() {
        var e = $(this),
            o = $(e.parents(".card"));
            $(o).children(".card-block").slideToggle(),
            $(o).children(".card-body").slideToggle();
        o.hasClass("full-card") || $(o).css("height", "auto"), $(this).children("a").children("span").toggle()
    })


    $(".SendOtp").on("click", function() {
     
        var e = $(this),
            o = $(e.parents(".modal"));
              $(o).children(".modal-dialog").addClass('open-otpverify');
              $(this).children(".modal-dialog").children(".close").addClass('otp')
              $(".close").on("click", function() {
                $(o).children(".modal-dialog").removeClass('open-otpverify');
         })
        
    })

          


    $('.custom-file-input').on('change', function(e) {
        var v = $(this),
            o = $(v.parents(".custom-file"));
        $(o).children('.custom-file-label').html(e.target.files[0].name);
        var extension = e.target.files[0].name.split('.').pop().toLowerCase()
        var reader = new FileReader();
        reader.onload = function(e) {
            if (extension == 'pdf') {
                $(o).children('.icon').addClass("displayimg")
                $(o).children(".icon").attr('src', 'https://image.flaticon.com/icons/svg/179/179483.svg');
                $(o).children('.docErr').removeClass("content-display")
            } else if (extension == 'jpg' || extension == 'jpeg' || extension == 'png') {
                $(o).children('.icon').addClass("displayimg")
                $(o).children('.docErr').removeClass("content-display")
                $(o).children('.fileUpload2').attr('src', reader.result);
            } else {
                $(o).children('.docErr').addClass("content-display")
                $(o).children('.fileUpload2').removeClass("displayimg")
            }
        }
        reader.readAsDataURL(e.target.files[0]);
    })
    $('#SendOtpEmail').click(function() {
        $(".otpemailsection").show();
        $("#SendOtpEmail").hide();
    });
    $('#SendOtpMobile').click(function() {
        $(".otpmobilesection").show();
        $("#SendOtpMobile").hide();
    });
    $("#otpOldnumber").click(function() {
        $("#otpOldform").toggle();
        $("#otpnewform").hide();
        $("#otpOldemailform").hide();
        $("#otpnewemailform").hide();
    })
    $("#otpNew").click(function() {
        $("#otpnewform").toggle();
        $("#otpOldform").toggle();
    })
    $(".back-form").click(function() {
        $("#otpnewform").toggle();
        $("#otpOldform").toggle();
    })
    $("#confirm-submit").click(function() {
        $("#otpnewform").toggle();
    })
    $("#otpOldemail").click(function() {
        $("#otpOldemailform").toggle();
        $("#otpnewemailform").hide();
        $("#otpOldform").hide();
        $("#otpnewform").hide();
    })
    $("#otpNewemail").click(function() {
        $("#otpnewemailform").toggle();
        $("#otpOldemailform").toggle();
    })
    $(".back-formemail").click(function() {
        $("#otpnewemailform").toggle();
        $("#otpOldemailform").toggle();
    })
    $("#confirmemail-submit").click(function() {
        $("#otpnewemailform").toggle();
    })
    $(document).ready(function() {
        $('#typescompany').hide();
        $('#pancard').hide();
        $('#gstfields').hide();
        $('.registercompany input[type="radio"]').click(function() {
            if ($(this).attr('id') == 'Yes') {
                $('#typescompany').show();
                $('#pancard').hide();
            }
            if ($(this).attr('id') == 'No') {
                $('#pancard').show();
                $('#typescompany').hide();
            }
        });
        // $('input[type="radio"]').click(function() {
        //     if ($(this).attr('id') == 'Others') {
        //         $('#othersfields').show();
        //     } else {
        //         $('#othersfields').hide();
        //     }
        // });
        $('.gstcompany input[type="radio"]').click(function() {
            if ($(this).attr('id') == 'gstYes') {
                $('#gstfields').show();
            } else {
                $('#gstfields').hide();
            }
        });
        // $('input[type="radio"]').click(function() {
        //     if ($(this).attr('id') == 'Others') {
        //         $('#othersfields').show();
        //     } else {
        //         $('#othersfields').hide();
        //     }
        // });
    });
})(window);