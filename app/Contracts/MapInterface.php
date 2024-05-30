<?php

namespace App\Contracts;

interface MapInterface
{
    public function distance($from_location, $to_location);
}
