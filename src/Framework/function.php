<?php

declare(strict_types=1);

namespace Framework;

function dd(mixed $value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}
