<?php

namespace App\Application\Query;

interface QueryBus
{
    public function handle(Query $query);
}
