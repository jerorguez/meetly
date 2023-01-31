<?php

namespace App\Interfaces;

interface CrudInterface {

        // Display all resources
        public function index();

        // Displays a form to insert a new resource
        public function create() : void;
    
        // Registers the new resource in the database
        public function store(array $data) : void;
    
        // Displays a specific resource
        public function show(string $id);
    
        // Displays a form for editing a resource
        public function edit(string $id) : void;
    
        // Updates the resource within the database
        public function update(array $data) : void;
    
        // Eliminates a resource
        public function destroy(string $id) : void;

}