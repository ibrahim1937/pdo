var idfiliere = -1;

$(document).ready( function() {

    $.ajax({

        url: 'controller/gestionFiliere.php',
        data : {op : 'affiche'},
        type : 'GET',
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            remplir(data);
            $(".datatable").DataTable({
                "bPaginate": false,
                "bInfo" : false,
            });

        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(textStatus);
        }
        

    });
    
});

$(document).on('click', '.supprimerfiliere', function() {
    var id = $(this).attr('name');
    $.ajax({
        url: 'controller/gestionFiliere.php',
        data : {
            op: 'supprimer',
            idf: id
        },
        type: 'GET',
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
            $(".datatable").DataTable().destroy();

            remplir(data);
            
            $(".datatable").DataTable({
                "bPaginate": false,
                "bInfo" : false,
            });
            

            

        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(textStatus);
        }
    });
});

$(document).on('click', '.modifierfiliere', function() {
    var parent = $(this).closest('tr');
    idfiliere = $(this).attr('name');

    var codefiliere = parent.find('td[name=codef]').text();
    var libelle =  parent.find('td[name=libelle]').text();

    // chenging the button name
    var btn = $("#btn_ajax");
    btn.html("Modifier");

    $("#codeinput").val(codefiliere);

    $("#libelleinput").val(libelle);

    // here deselect all options

    $("#class-section-header").text("Modifier une filiere");


});


$(document).on('click', '#btn_ajax', function() {
    if($(this).text() == "Modifier"){
        var codefiliere  = $("#codeinput").val();
        var libelle = $("#libelleinput").val();
        console.log(libelle);

        $.ajax({
            url: 'controller/gestionFiliere.php',
            data: {op : 'modifier', idf : idfiliere , codef : codefiliere , libellef : libelle},
            type: 'GET',
            dataType: 'json',
            success: function (data, textStatus, jqXHR) {
                $(".datatable").DataTable().destroy();

                remplir(data);
            
                $(".datatable").DataTable({
                    "bPaginate": false,
                    "bInfo" : false,
                });
    
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(textStatus);
            }

        
        });

        // initialising

        $("#codeinput").val("");
        $("#libelleinput").val("");
        $("#class-section-header").text("Ajouter une filiere");
        var btn = $("#btn_ajax");
        btn.html("Ajouter");

        idfiliere = -1;
        



    } else if ($(this).text() == "Ajouter"){
        var inputc = $("#codeinput");
        var inputl = $("#libelleinput");

        if(inputc.val() && inputl.val()){

            var codefiliere = inputc.val();
            var libelle = inputl.val();

            $.ajax({
                url: 'controller/gestionFiliere.php',
                data: { op: 'ajouter', codef : codefiliere, libellef : libelle },
                type: 'GET',
                dataType: 'json',
                success: function (data, textStatus, jqXHR) {

                    $(".datatable").DataTable().destroy();

                    remplir(data);


                
                    $(".datatable").DataTable({
                        "bPaginate": false,
                        "bInfo" : false,
                    });
        
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log(textStatus);
                }


            });


            inputc.val("");
            inputl.val("");

            
        }
    }
});



function remplir(data){

    var content = $("#filierecontent");
    var ligne = '';
    for(let i =0; i< data.length ; i++){
        ligne += '<tr><th scope="row">' + data[i].id + '</th>';
        ligne += '<td name="codef">' + data[i].code + '</td>';
        ligne += '<td name="libelle">' + data[i].libelle + '</td>';
        ligne += '<td><button type="button"' + 'name="' + data[i].id + '" class="btn btn-danger supprimerfiliere">Supprimer</button></td>';
        ligne += '<td><button type="button" class="btn btn-secondary modifierfiliere" name="' + data[i].id + '">Modifier</button></td></tr>';

    }

    content.html(ligne);
};