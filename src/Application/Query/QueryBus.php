<?php

namespace SymfonyCraft\JobBoard\Application\Query;

interface QueryBus
{
    public function handle(Query $query);
}
