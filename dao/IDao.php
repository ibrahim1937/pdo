<?php 

interface IDao {
    function create($o); // creating object
    function delete($o); // deleting object
    function update($o); // updating the object
    function findById($id); // finding the object by id
    function findAll(); // finding all objects
}