<?php

namespace Juzaweb\Hooks;

use Juzaweb\Hooks\Abstracts\Event;

class Filter extends Event
{
    protected $value = '';

    /**
     * Filters a value.
     *
     * @param  string  $action  Name of filter
     * @param  array  $args  Arguments passed to the filter
     *
     * @return mixed Always returns the value
     * @throws \Exception
     */
    public function fire(string $action, array $args)
    {
        // get the value, the first argument is always the value
        $this->value = $args[0] ?? null;

        if ($this->getListeners()) {
            $this->getListeners()
                ->where('hook', $action)
                ->each(
                    function ($listener) use ($action, $args) {
                        $parameters = [];
                        $args[0] = $this->value;
                        for ($i = 0; $i < $listener['arguments']; $i++) {
                            $value = $args[$i] ?? null;
                            $parameters[] = $value;
                        }

                        $this->value = call_user_func_array(
                            $this->getFunction($listener['callback']),
                            $parameters
                        );
                    }
                );
        }

        return $this->value;
    }
}
