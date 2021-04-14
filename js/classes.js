
var idclasse = -1;
var idfiliere = -1;
$(document).ready( function () {
    
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
    $.ajax({
        url: 'controller/gestionFiliere.php',
        data: { op: "affiche"},
        type: 'GET',
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            remplirSelect(data);
        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(textStatus);
        }
        
    });



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
            $(".datatable").DataTable().destroy();

            remplir(data);
            
            $(".datatable").DataTable();

        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(textStatus);
        }
    });
});

$(document).on('click', '.modifierclasse', function() {
    var parent = $(this).closest('tr');
    idfiliere = $(this).attr('name');
    idclasse = parent.find('th').text();
    var codeclasse = parent.find('td[name=codec]').text();
    var filiere =  parent.find('td[name=filiere]').text();

    // chenging the button name
    var btn = $("#btn_ajax");
    btn.html("Modifier");

    $("#classeinput").val(codeclasse);

    $("#filiereoptions").children().each(function() {
        if(this.selected){
            select = $(this);
            select.attr('selected', false);
        }
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
        $(this).html("Ajouter");
        $("#class-section-header").text("Ajouter une classe");
        $("#filiereoptions").children().each(function() {
            if(this.selected){
                select = $(this);
                select.attr('selected', false);
            }
        });

        idfiliere = -1;
        



    } else if ($(this).text() == "Ajouter"){
        var input = $("#classeinput");
        var select = $("#filiereoptions");
        if(input.val() && select.val() != "Open this select menu"){
            idfiliere = select.find(':selected').attr('name');
            var codeclasse = input.val();
            $.ajax({
                url: 'controller/gestionClasse.php',
                data: { op: 'ajouter', codec : codeclasse, filiereid : idfiliere },
                type: 'GET',
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
            input.val("");
            initialize();

            select.val([]);
            select.children().first().attr('selected', 'selected');
            var value = select.children().first().text();
            select.val(value);
        }
    }
});




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
};

function remplirSelect(data){
    var content = $("#filiereoptions");
    var ligne = '<option selected>Open this select menu</option>';
    for(let i =0; i< data.length ; i++){
        ligne += '<option name="' + data[i].id + '">' + data[i].code + '</option>'
    }

    content.html(ligne);

}

function initialize(){
    $("#filiereoptions").children().each(function() {
        if(this.selected){
            select = $(this);
            select.attr('selected', false);
        }
    });
}
