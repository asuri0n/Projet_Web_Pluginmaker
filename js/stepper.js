var step1 = true;
var step2 = false;
var step3 = false;
var step4 = false;

var active = 1;

var elem1 = $('#step1');
var elem2 = $('#step2');
var elem3 = $('#step3');
var elem4 = $('#step4');

var nom = $('#nom');
var prenom = $('#prenom');
var pseudo = $('#pseudo');
var skype = $('#skype');
var email = $('#email');
var pluginName = $('#name');
var version = $('#version');
var description = $('#description');
var min = $('#min');
var max = $('#max');
var dateMin = $('#dateMin');
var dateMax = $('#dateMax');

$('#'+active+'step').addClass('active editable');

elem2.hide();
elem3.hide();
elem4.hide();

function change(number) {
    switch (number) {
        case 1:
            if ( step1 ) {
                $('#'+active+'step').removeClass('active editable');
                $('#'+number+'step').addClass('active editable');
                active = 1;
                elem1.show();
                elem2.hide();
                elem3.hide();
                elem4.hide();
            }
            break;
        case 2:
            if ( step2 ) {
                $('#'+active+'step').removeClass('active editable');
                $('#'+number+'step').addClass('active editable');
                active = 2;
                elem1.hide();
                elem2.show();
                elem3.hide();
                elem4.hide();
            }
            break;
        case 3:
            if ( step3 ) {
                $('#'+active+'step').removeClass('active editable');
                $('#'+number+'step').addClass('active editable');
                active = 3;
                elem1.hide();
                elem2.hide();
                elem3.show();
                elem4.hide();
            }
            break;
        case 4:
            if ( step4 ) {
                $('#'+active+'step').removeClass('active editable');
                $('#'+number+'step').addClass('active editable');
                active = 4;
                elem1.hide();
                elem2.hide();
                elem3.hide();
                elem4.show();
            }
            break;
    }
}

function checkStep(number) {
    if ( number == 1 ) {
        if ( nom.val() != "" && prenom.val() != "" && pseudo.val() != "" && email.val() != "" ) {
            step2 = true;
            change(2);
        } else {
            toast("Veuillez saisir tout les champs requis.", 'error', 'Erreur', 5000);
        }
    } else if ( number == 2 ) {
        if ( pluginName.val() != "" && version.val() != "" && description.val() != "" ) {
            step3 = true;
            change(3);
        } else {
            toast("Veuillez saisir tout les champs requis.", 'error', 'Erreur', 5000);
        }
    } else if ( number == 3 ) {
        if ( min.val() != "" && max.val() != "" ) {
            step4 = true;
            change(4);
        } else {
            toast("Veuillez saisir tout les champs requis.", 'error', 'Erreur', 5000);
        }
    } else if ( number == 4 ) {
        if ( dateMin.val() != "" && dateMax.val() != "" ) {
            finish();
        } else {
            toast("Veuillez saisir tout les champs requis.", 'error', 'Erreur', 5000);
        }
    }
}

function finish() {
    $.ajax({
        type: "POST",
        url: '../ajax/sendRequest.php',
        data: {
            'nom': nom.val()+" "+prenom.val(),
            'skype': skype.val(),
            'pseudo': pseudo.val(),
            'budget-min': min.val(),
            'budget-max': max.val(),
            'date-min': dateMin.val(),
            'date-max': dateMax.val(),
            'plugin': pluginName.val(),
            'version': version.val(),
            'description': description.val(),
            'email': email.val()
        },
        success: function(response) {
            toast("Commande envoyé avec succès.", 'success', 'Succès', 5000);
            reset();
        }
    });
}

function reset() {
    step1 = true;
    step2 = false;
    step3 = false;
    step4 = false;
    change(1);

    nom.val('');
    prenom.val('');
    pseudo.val('');
    skype.val('');
    email.val('');
    pluginName.val('');
    version.val('');
    description.val('');
    min.val('');
    max.val('');
    dateMin.val('');
    dateMax.val('');
}