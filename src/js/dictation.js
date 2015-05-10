/*
* Author: Amit Agarwal
* Modified by: Douglas Rocha
*/
function clearSlate() {
    if (working) {
        speech.stop();
    }
    document.getElementById("labnol").value = "";
    document.getElementById("notfinal").value = "";
    final_transcript = "";
    reset();
}

function reset() {
    working = false;
}

function actionClick() {
    if (working) {
        /*stopRecording(this);*/
		stopRecording(this);
		speech.stop();
        reset();
		$("#btn_rec").toggleClass("btn-success");
		$("#btn_rec").toggleClass("btn-danger");
		document.getElementById("btn_rec").value = "Gravar";
    } else {
        speech.start();
        working = true;
		final_transcript = "";
        document.getElementById("btn_rec").value = "Parar";
		$("#btn_rec").toggleClass("btn-success");
		$("#btn_rec").toggleClass("btn-danger");
		/*startRecording(this);*/
		startRecording(this);
    }
}

function toggleVisibility(selectedTab) {
    var content = document.getElementsByClassName('info');
    for (var i = 0; i < content.length; i++) {
        if (content[i].id == selectedTab) {
            content[i].style.display = 'block';
        } else {
            content[i].style.display = 'none';
        }
    }
}

function save() {
    var d = document.getElementById("labnol").value;
    filepicker.setKey('AeoWySYsRQWugIlof6Gegz');
    filepicker.store(d, function(a) {
        filepicker['export'](a, {
            extension: '.txt',
            services: ['DROPBOX', 'GOOGLE_DRIVE', 'COMPUTER', 'SEND_EMAIL']
        }, function(a) {});
    });
}

function updateLang(sel) {
    var value = sel.options[sel.selectedIndex].value;
    speech.lang = "pt-br";
    localStorage["language"] = value;
}

function format(s) {
    return s.replace(/\n/g, '<br>');
}

function capitalize(s) {
    return s.replace(/\S/, function(m) {
        return m.toUpperCase();
    });
}

function initialize() {
    speech = new webkitSpeechRecognition();
    speech.continuous = true;
    speech.maxAlternatives = 5;
    speech.interimResults = true;
    speech.lang = "pt-br";
    speech.onend = reset;
}

var clear, working, speech, final_transcript = "";

if (typeof(webkitSpeechRecognition) !== 'function') {

    document.getElementById("labnol").value = "We are sorry but Dictation requires the latest version of Google Chrome on your desktop.";

} else {

    if (typeof(localStorage["language"]) == 'undefined') {
        localStorage["language"] = 12;
    }

    if (typeof(localStorage["transcript"]) == 'undefined') {
        localStorage["transcript"] = "";
    }

    
    final_transcript = localStorage["transcript"];

    setInterval(function() {
        var text = document.getElementById("labnol").value;
        if (text !== localStorage["transcript"]) {
            localStorage["transcript"] = text;
        }
    }, 2000);

    initialize();
    reset();

    speech.onerror = function(e) {
        var msg = e.error + " error";
        if (e.error === 'no-speech') {
            msg = "No speech was detected. Please try again.";
        } else if (e.error === 'audio-capture') {
            msg = "Please ensure that a microphone is connected to your computer.";
        } else if (e.error === 'not-allowed') {
            msg = "The app cannot access your microphone. Please go to chrome://settings/contentExceptions#media-stream and allow Microphone access to this website.";
        }
        setTimeout(function() {
        }, 5000);
    };

    speech.onresult = function(e) {
        var interim_transcript = '';
        if (typeof(e.results) == 'undefined') {
            reset();
            return;
        }
        for (var i = e.resultIndex; i < e.results.length; ++i) {
            var val = e.results[i][0].transcript;
            if (e.results[i].isFinal) {
                final_transcript += " " + val;
            } else {
                interim_transcript += " " + val;
            }
        }
		
		document.getElementById("final_transcript").value = format(capitalize(final_transcript));
		
        /*document.getElementById("labnol").innerHTML = format(capitalize(final_transcript));
        document.getElementById("notfinal").innerHTML = format(interim_transcript);*/
    };
}

(function(i, s, o, g, r, a, m) {
    i['GoogleAnalyticsObject'] = r;
    i[r] = i[r] || function() {
        (i[r].q = i[r].q || []).push(arguments)
    }, i[r].l = 1 * new Date();
    a = s.createElement(o),
    m = s.getElementsByTagName(o)[0];
    a.async = 1;
    a.src = g;
    m.parentNode.insertBefore(a, m)
})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

ga('create', 'UA-50062-33', 'dictation.io');
ga('send', 'pageview');