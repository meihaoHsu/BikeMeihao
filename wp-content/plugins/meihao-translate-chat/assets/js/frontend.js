jQuery(document).ready(function($) {
    $('#translate-log-open').click(function () {
        $('#translate-log-wrapper').toggle();
    })


    $('#translate-button').click(function() {
        translateFunction();
    });

    $('#changeLanguage').click(function (){
        var inputLanguage = $('#inputLanguage').val();
        var outputLanguage = $('#outputLanguage').val();
        $('#inputLanguage').val(outputLanguage);
        $('#outputLanguage').val(inputLanguage);
    });

    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
    if (!SpeechRecognition) {
        $("#outputText").text("Speech recognition not supported!");
        $("#voice-input").prop("disabled", true);
    } else {
        const recognition = new SpeechRecognition();
        recognition.interimResults = true;

        recognition.addEventListener("result", function(event) {
            const transcript = event.results[event.resultIndex][0].transcript;
            $("#inputText").text(transcript);
            translateFunction();
        });

        $("#voice-input").on("click", function() {
            recognition.lang = $("#inputLanguage").val();
            recognition.start();
            $('#inputText').text('');
            var btnValue = $('#voice-input').html();
            $("#voice-input").prop("disabled", true);
            $("#voice-input").removeClass("btn-info", true);
            $("#voice-input").addClass("btn-danger", true);
            $("#voice-input").html("Listening....");

            setTimeout(function (e) {
                $("#voice-input").prop("disabled", false);
                $("#voice-input").removeClass("btn-danger", true);
                $("#voice-input").addClass("btn-info", true);
                $("#voice-input").html(btnValue);

                recognition.stop();

            },10000);

        });
    }

    function translateFunction(){

        var inputLanguage = $('#inputLanguage').val();
        var outputLanguage = $('#outputLanguage').val();
        var inputText = $('#inputText').val();
        $.post('../../../wp-admin/admin-ajax.php', {
            action: 'ajax_translate_text', // 自取一個action的名稱
            inputLanguage: inputLanguage,
            outputLanguage: outputLanguage,
            inputText: inputText,
        }, function (result) {
            var data = JSON.parse( result );
            if (data.result === '1'){
                $('#outputText').text('');
                $('#outputText').text(data.text);
            }
        });
    }


});