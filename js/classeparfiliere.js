
var idclasse = -1;
var idfiliere = -1;

$(document).ready( function() {

    $.ajax({
        url: 'controller/gestionFiliere.php',
        data: {op : 'affiche'},
        type: 'GET',
        dataType: 'json',
        success: function(data){
            remplirSelect(data);
        }
    });
    $.ajax({

        url: 'controller/gestionClasse.php',
        data : {op : 'afficher'},
        type : 'GET',
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            remplir(data);
            $(".datatable").DataTable();

        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(textStatus);
        }
    });

});

$(document).on('change', '#filiereoptions', function(){
    if($(this).val() != "Open this select menu"){
        var idfiliere = $('#filiereoptions').find(':selected').attr('name');

        $.ajax({

            url: 'controller/gestionClasse.php',
            data : {op : 'filtrage', idf : idfiliere},
            type : 'GET',
            dataType: 'json',
            success: function (data, textStatus, jqXHR) {

                $(".datatable").DataTable().destroy();

                remplir(data);
                $(".datatable").DataTable();

            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(textStatus);
            }
        });
    } else {

        $("#filiereoptions").find('option').each(function() {
            $(this).attr('selected', false);
        });
        
        $(this).attr('selected', 'selected');

        $.ajax({

            url: 'controller/gestionClasse.php',
            data : {op : 'afficher'},
            type : 'GET',
            dataType: 'json',
            success: function (data, textStatus, jqXHR) {

                $(".datatable").DataTable().destroy();
                remplir(data);
                $(".datatable").DataTable();
    
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(textStatus);
            }
        });
    }
});

$(document).on('click', '.modifierclasse', function() {


    var parent = $(this).closest('tr');
    idfiliere = $(this).attr('name');
    idclasse = parent.find('th').text();
    var codeclasse = parent.find('td[name=codec]').text();
    var filiere =  parent.find('td[name=filiere]').text();



    $(".classecontainer").removeClass('hide');

    $("#classeinput").val(codeclasse);


    $("#filiereoptions").find('option').each(function() {
        $(this).attr('selected', false);
    });

    
    
    test = '' + idfiliere;

    var search = 'option[name=' + idfiliere + ']';

    $filieretest = $("#filiereoptions").find(search).attr('selected', 'selected');


    // here deselect all options

    $("#class-section-header").text("Modifier une classe");


});


$(document).on('click', '#btn_ajax', function() {
    if($(this).text() == "Modifier"){
        var codeclasse = $("#classeinput").val();
        $("#filiereoptions").children().each(function() {
            if(this.selected){
                select = $(this);
                 idfiliere = select.attr('name');
            }
        });

        $.ajax({
            url: 'controller/gestionClasse.php',
            data: {op : 'modifier', idc : idclasse , codec : codeclasse , filiereid : idfiliere},
            type: 'GET',
            dataType: 'json',
            success: function (data, textStatus, jqXHR) {
                //
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(textStatus);
            }
        });
        var idfiliere1 = $('#filiereoptions').find(':selected').attr('name');

        $.ajax({

            url: 'controller/gestionClasse.php',
            data : {op : 'filtrage', idf : idfiliere1},
            type : 'GET',
            dataType: 'json',
            success: function (data, textStatus, jqXHR) {

                $(".datatable").DataTable().destroy();

                remplir(data);
                $(".datatable").DataTable();

            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(textStatus);
            }
        });

        // initialising

        $("#classeinput").val("");
        $("#class-section-header").text("Chercher classe par filiere");
        $("#filiereoptions").children().each(function() {
            if(this.selected){
                select = $(this);
                select.attr('selected', false);
            }
        });

        $(".classecontainer").addClass('hide');
        idfiliere = -1;
    } 
});

$(document).on('click', '.supprimerclasse', function() {
    var id = $(this).attr('name');
    $.ajax({
        url: 'controller/gestionClasse.php',
        data : {
            op: 'supprimer',
            idc: id
        },
        type: 'GET',
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {

        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(textStatus);
        }
    });

    var idfiliere1 = $('#filiereoptions').find(':selected').attr('name');

    $.ajax({

            url: 'controller/gestionClasse.php',
            data : {op : 'filtrage', idf : idfiliere1},
            type : 'GET',
            dataType: 'json',
            success: function (data, textStatus, jqXHR) {

                $(".datatable").DataTable().destroy();

                remplir(data);
                $(".datatable").DataTable();

            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(textStatus);
            }
    });

});



function remplirSelect(data){
    var content = $("#filiereoptions");
    var ligne = '<option selected>Open this select menu</option>';
    for(let i =0; i< data.length ; i++){
        ligne += '<option name="' + data[i].id + '">' + data[i].code + '</option>'
    }

    content.html(ligne);

}
function remplir(data){

        var content = $("#classecontent");
        var ligne = '';
        for(let i =0; i< data.length ; i++){
            ligne += '<tr><th scope="row">' + data[i].id + '</th>';
            ligne += '<td name="codec">' + data[i].code + '</td>';
            ligne += '<td name="filiere">' + data[i].filiere.code + '</td>';
            ligne += '<td><button type="button"' + 'name="' + data[i].id + '" class="btn btn-danger supprimerclasse">Supprimer</button></td>';
            ligne += '<td><button type="button" class="btn btn-secondary modifierclasse" name="' + data[i].filiere.id + '">Modifier</button></td></tr>';
    
        }
    
        content.html(ligne);
}
