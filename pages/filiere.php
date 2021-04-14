                    <div class="row justify-content-center">

                        <form class="classeform">
                                <div class="form-group nopad">
                                    <h2 id ="class-section-header">Ajouter une Filiere</h2>
                                </div>
                                <div class="container">
                                        <div class="form-group">
                                            <label for="classeinput">Code filiere</label>
                                            <input type="text" class="form-control" id="codeinput"  placeholder="Enter le code de al filiere">
                                        </div>
                                        <div class="form-group">
                                            <label for="classeinput">Libelle Filiere</label>
                                            <input type="text" class="form-control" id="libelleinput"  placeholder="Enter le libelle de la filiere">
                                        </div>
                                        <div class="justify-content-center">
                                            <button type="button" class="btn btn-success ajouter" id="btn_ajax">Ajouter</button>
                                        </div>
                                </div>
                        </form>
                    </div>

                    <div class="row justify-content-center">

                        <div class="tablecontainer">
                            <div class="container mb-3 mt-3">
                                <table class="table table-striped table-bordered display datatable" >
                                        <thead>
                                            <tr>
                                            <th scope="col">#id</th>
                                            <th scope="col">code</th>
                                            <th scope="col">libelle</th>
                                            <th scope="col">Supprimer</th>
                                            <th scope="col">Modifier</th>
                                            </tr>
                                        </thead>
                                        <tbody id="filierecontent">
                                            
                                        </tbody>
                                </table>

                            </div>
                        
                    </div>

                    </div>
