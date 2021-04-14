<?php
                                    include_once 'services/ClasseServices.php';
                                    include_once 'beans/Classe.php';

                                    $var1 = new ClasseServices();

                                    foreach( $var1->findAll() as $e1){
                                        
                                   

                                ?>
                                <tr>
                                    <th scope="row"><?php echo $e1->getId(); ?></th>
                                    <td><?php echo $e1->getCode(); ?></td>
                                    <td><?php echo $e->getId_f(); ?></td>
                                </tr>
                                <?php  } ?>