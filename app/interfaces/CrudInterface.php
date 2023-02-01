<?php

namespace App\Interfaces;

/**
 * Interface CrudInterface
 * 
 * This interface is used for classes that need to implement 
 * CRUD methods. Implements 7 controllers to display data and 
 * modify the database.
 * 
 * PHP version: 8.1
 * 
 * 
 * @author Jerobel Rodriguez <github.com/jerorguez>
 * @package App\Interfaces
 * @license MIT
 * @version 1.0.0
 */
interface CrudInterface {

        /**
         * Displays all resources in the database
         *
         * The correct way to use it is to generate a variable 
         * with the result of the query before the require to 
         * the html or php code.
         * 
         * @return void
         */
        public function index() : void;

        /**
         * Displays a form to insert a new resource
         * 
         * Calling this function should redirect or display the 
         * form for the insertion of a new resource in the database.
         *
         * @return void
         */
        public function create() : void;
    
        /**
         * Registers the new resource in the database
         * 
         * When this function is called after passing the necessary 
         * validations, the new resource will be stored in the database.
         *
         * @param array $data => Data sent by $_POST
         * @return void
         */
        public function store(array $data) : void;

        /**
         * Displays a specific resource
         *
         * Displays a specific resource from the database 
         * when its id is passed.
         * 
         * @param string $id
         * @return void
         */
        public function show(string $id);
    
        /**
         * Displays a form for editing a resource
         *
         * Displays a filled form with the data to be edited from 
         * the id provided.
         * 
         * @param string $id
         * @return void
         */
        public function edit(string $id) : void;
    
        /**
         * Updates the resource within the database
         *
         * When sent to call it updates the resource in the database after 
         * passing the necessary validations. The form should send the id 
         * per post and include it in the $data
         * 
         * @param array $data
         * @return void
         */
        public function update(array $data) : void;
    
        /**
         * Eliminates a resource
         *
         * After passing the id of the resource, proceed to delete it 
         * from the database.
         * 
         * @param string $id
         * @return void
         */
        public function destroy(string $id) : void;

}