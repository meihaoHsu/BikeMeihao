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
        // 初始化語音辨識物件
        const recognition = new SpeechRecognition();
        recognition.interimResults = true;

        //語音辨識結果顯示
        recognition.onresult = function(event) {
            const results = event.results;
            for (const result of results) {
                //語音辨識準確度要求
                if (result.confidence < 0.9) {
                    results.splice(results.indexOf(result), 1);
                }
            }
            const transcript = results[0].transcript;
            $("#inputText").text(transcript);
            translateFunction();

        };

        // 判斷用戶是否已講完話
        recognition.onend = function(event) {
            // 語音輸入結束
            $("#voice-input").prop("disabled", false);
            $("#voice-input").removeClass("btn-danger", true);
            $("#voice-input").addClass("btn-info", true);
            $("#voice-input").html('語音輸入');
        };

        //點擊後觸發開始辨識
        $("#voice-input").on("click", function() {
            recognition.lang = $("#inputLanguage").val();
            recognition.start();
            $('#inputText').text('');
            var btnValue = $('#voice-input').html();
            $("#voice-input").prop("disabled", true);
            $("#voice-input").removeClass("btn-info", true);
            $("#voice-input").addClass("btn-danger", true);
            $("#voice-input").html("請說話...");

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