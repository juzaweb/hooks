<?php

namespace Juzaweb\Hooks\Abstracts;

use Illuminate\Support\Collection;
use Juzaweb\Hooks\HashedCallable;

abstract class Event
{
    /**
     * Holds the event listeners.
     *
     * @var Collection
     */
    protected Collection $listeners;

    public function __construct()
    {
        $this->listeners = collect([]);
    }

    /**
     * Adds a listener.
     *
     * @param  string  $hook Hook name
     * @param mixed $callback Function to execute
     * @param  int  $priority Priority of the action
     * @param  int  $arguments Number of arguments to accept
     */
    public function listen(string $hook, mixed $callback, int $priority = 20, int $arguments = 1): static
    {
        $this->listeners->push(
            [
                'hook' => $hook,
                'callback' => $callback instanceof \Closure ? new HashedCallable($callback) : $callback,
                'priority' => $priority,
                'arguments' => $arguments,
            ]
        );

        return $this;
    }

    /**
     * Removes a listener.
     *
     * @param  string  $hook Hook name
     * @param mixed $callback Function to execute
     * @param  int  $priority Priority of the action
     */
    public function remove(string $hook, mixed $callback, int $priority = 20): void
    {
        if ($this->listeners->isNotEmpty()) {
            $this->listeners->where('hook', $hook)
                ->filter(
                    function ($listener) use ($callback) {
                        if ($callback instanceof \Closure) {
                            return (new HashedCallable($callback))->is($listener['callback']);
                        }

                        return $callback === $listener['callback'];
                    }
                )
                ->where('priority', $priority)
                ->each(
                    function ($listener, $key) {
                        $this->listeners->forget($key);
                    }
                );
        }
    }

    /**
     * JW CMS: Remove all listeners with given hook in collection. If no hook, clear all listeners.
     *
     * @param  string|null  $hook Hook name
     */
    public function removeAll(string $hook = null): void
    {
        if ($hook) {
            if ($this->listeners->isNotEmpty()) {
                $this->listeners->where('hook', $hook)
                    ->each(
                        function ($listener, $key) {
                            $this->listeners->forget($key);
                        }
                    );
            }
        } else {
            // no hook was specified, so clear entire collection
            $this->listeners = collect([]);
        }
    }

    /**
     * TA CMS: Gets a sorted list of all listeners.
     *
     * @return array
     */
    public function getListeners(): Collection
    {
        // $listeners = $this->listeners->values();
        // sort by priority
        // uksort($values, function ($a, $b) {
        //     return strnatcmp($a, $b);
        // });

        return $this->listeners->sortBy('priority');
    }

    /**
     * TA CMS: Gets the function.
     *
     * @param mixed $callback Callback
     *
     * @return mixed A closure, an array if "class@method" or a string if "function_name"
     */
    protected function getFunction($callback): mixed
    {
        if (is_string($callback) && strpos($callback, '@')) {
            $callback = explode('@', $callback);

            return [app('\\' . $callback[0]), $callback[1]];
        } elseif (is_string($callback)) {
            return [app('\\' . $callback), 'handle'];
        } elseif (is_callable($callback)) {
            return $callback;
        } elseif (is_array($callback)) {
            return $callback;
        } else {
            throw new \Exception('$callback is not a Callable', 1);
        }
    }

    /**
     * TA CMS: Fires a new action.
     *
     * @param  string  $action Name of action
     * @param  array  $args Arguments passed to the action
     */
    abstract public function fire(string $action, array $args);
}
