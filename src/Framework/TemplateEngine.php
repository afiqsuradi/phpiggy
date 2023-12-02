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
        include $this->resolve($path);
        $output = ob_get_contents();
        ob_end_clean();

        return $output;
    }

    public function resolve(string $template)
    {
        return "{$this->path}/{$template}";
    }
}
