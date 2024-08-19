<?php 

namespace App\Controllers;


interface ControllerInterface 
{
    public function index(): void;
    public function details($id): void;
    public function insert(): void;
    public function update($id): void;
    public function delete($id): void;
}