                    <div class="row justify-content-center">

                        <form class="classeform">
                                <div class="form-group nopad">
                                    <h2 id ="class-section-header">Ajouter une classe</h2>
                                </div>
                                <div class="container">
                                        <div class="form-group">
                                            <label for="classeinput">Classe</label>
                                            <input type="text" class="form-control" id="classeinput"  placeholder="Enter email">
                                        </div>
                                        <div class="form-group">
                                            <label for="filiereoptions">Filiere</label>
                                            <select class="selectpicker" style="display: block; width: 100%;" id = "filiereoptions" aria-label="Default select example">
                                                    <option selected>Open this select menu</option>
                                            </select>
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
                                            <th scope="col">Classe</th>
                                            <th scope="col">Filiere</th>
                                            <th scope="col">Supprimer</th>
                                            <th scope="col">Modifier</th>
                                            </tr>
                                        </thead>
                                        <tbody id="classecontent">
                                            
                                        </tbody>
                                </table>

                            </div>
                            
                        </div>

                    </div>
