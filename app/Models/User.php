<?php

namespace App\Models;

class User {
    private $id;

    function __construct(int $id) {
        $this->id = $id;
    }

    public function getId(): int {
        return $this->id;
    }
}