<?php

namespace Juzaweb\Hooks;

use Juzaweb\Hooks\Abstracts\Event;

class Action extends Event
{
    /**
     * JUZAWEB CMS: Filters a value.
     *
     * @param  string  $action  Name of action
     * @param  array  $args  Arguments passed to the filter
     *
     * @return void Always returns the value
     * @throws \Exception
     */
    public function fire(string $action, array $args)
    {
        if ($this->getListeners()) {
            $this->getListeners()->where('hook', $action)->each(
                function ($listener) use ($action, $args) {
                    $parameters = [];
                    for ($i = 0; $i < $listener['arguments']; $i++) {
                        $value = $args[$i] ?? null;
                        $parameters[] = $value;
                    }
                    call_user_func_array($this->getFunction($listener['callback']), $parameters);
                }
            );
        }
    }
}
