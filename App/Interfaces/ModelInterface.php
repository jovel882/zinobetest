<?php
namespace App\Interfaces;

interface ModelInterface
{
    public function getAll();
    static public function findFromId(int $id);
}
?>