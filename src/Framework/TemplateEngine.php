<?php

namespace Framework;


class TemplateEngine
{
    public function __construct(
        private string $path
    ) {
    }

    public function render(string $path, array $data = [])
    {
        extract($data, EXTR_SKIP);
        include "{$this->path}/{$path}";
    }
}
