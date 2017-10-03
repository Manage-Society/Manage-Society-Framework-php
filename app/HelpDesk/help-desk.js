$(document).ready(function() {

    var api = "app_21";

    var key = "123";
    var session = $.cookie('id_client_helpdesk');
    if (session == undefined) {
        session = "";
    }


    var serveur = $('#help-desk-123456').attr('nomserveur');


    var params = '{"controller":"helpdesk","action":"new_help_desk","serveur":"' + serveur + '","id_session":"' + session + '"}';


    $.ajax({
        type: "GET",
        url: "http://www.manage-society.com/controller/api.php",
        crossDomain: true,
        data: "app_id=" + api + "&mdp_id=" + key + "&params=" + params + "&type=JSON",
        success: function(data) {
            console.log(data);
            $("#help-desk-123456").prepend(data.data);
        },
        error: function(error) {
            console.log(error);
        }
    });
    $("body").delegate("#new_request_helpdesk", "submit", function() {
        event.preventDefault();
        $("#form_new_user_help_desk").toggleClass('hide');
        $("#loading_help_desk").toggleClass('hide');
        var nom = $("#nomprenomhelpdesk").val();
        var email = $("#emailhelpdesk").val();
        var telephone = $("#telephonehelpdesk").val();

        var params = '{"controller":"helpdesk","action":"new_user","serveur":"' + serveur + '","nom":"' + nom + '","email":"' + email + '","telephone":"' + telephone + '"}';


        $.ajax({
            type: "GET",
            url: "http://www.manage-society.com/controller/api.php",
            crossDomain: true,
            data: "app_id=" + api + "&mdp_id=" + key + "&params=" + params + "&type=JSON",
            success: function(data) {
                $("#begintalkhelpdesk").val("1");
                $("#loading_help_desk").toggleClass('hide');
                $("#tchat_help_desk").toggleClass('hide');
                $("#div_form_chat_helpdesk").toggleClass('hide');

                $("#idsessionhelpdesk").val(data.data);
                $.cookie('id_client_helpdesk', data.data);
            },
            error: function(error) {
                console.log(error);
            }
        });
        $(this)[0].reset();
    });

    $("body").delegate("#add_blab_helpdesk", "submit", function() {
        event.preventDefault();

        var session = $.cookie('id_client_helpdesk');

        var params = '{"controller":"helpdesk","action":"blab_user","serveur":"' + serveur + '","id_session":"' + session + '","blab":"' + $("#rep_helpdesk").val() + '"}';


        $.ajax({
            type: "GET",
            url: "http://www.manage-society.com/controller/api.php",
            crossDomain: true,
            data: "app_id=" + api + "&mdp_id=" + key + "&params=" + params + "&type=JSON",
            success: function(data) {
                console.log(data);
            },
            error: function(error) {
                console.log(error);
            }
        });

    });


    function chargement() {
        // traitement

        if ($("#begintalkhelpdesk").val() == 1) {

            var params = '{"controller":"helpdesk","action":"blab_user","serveur":"' + serveur + '","id_session":"' + $.cookie('id_client_helpdesk') + '"}';
            $.ajax({
                type: "GET",
                url: "http://www.manage-society.com/controller/api.php",
                crossDomain: true,
                data: "app_id=" + api + "&mdp_id=" + key + "&params=" + params + "&type=JSON",
                success: function(data) {
                    console.log(data);
                    $("#tchat_help_desk").html(data.data);
                },
                error: function(error) {
                    console.log(error);
                }
            });

        }

        setTimeout(chargement, 2000); /* rappel après 2 secondes = 2000 millisecondes */

    }

    chargement();



    $("body").delegate(".open-small-chat-helpdesk", "click", function() {


        $('.small-chat-box-helpdesk').toggleClass('active');
    });

    // Initialize slimscroll for small chat

    $('.small-chat-box-helpdesk .content').slimScroll({
        height: '234px',
        railOpacity: 0.4
    });
    $('.content-helpdesk').slimScroll({
        height: '250px'
    });
});
