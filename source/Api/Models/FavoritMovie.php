<?php

namespace Source\Api\Models;

use CoffeeCode\DataLayer\DataLayer;

class FavoritMovie extends DataLayer
{
    /**
     * @var mixed|string|null
     */

    public function __construct()
    {
        parent::__construct("favorits_movies", ["id_movie", "user_hash", "title"], "id", true);
    }
}