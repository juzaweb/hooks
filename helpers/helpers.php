<?php

use Juzaweb\Hooks\Facades\Hook;

if (!function_exists('do_action')) {
    /**
     * JUZAWEB CMS: Do action hook
     *
     * @param string $tag
     * @param mixed ...$args Additional parameters to pass to the callback functions.
     * @return void
     * */
    function do_action(string $tag, ...$args): void
    {
        Hook::action($tag, ...$args);
    }
}

if (!function_exists('add_action')) {
    /**
     * JUZAWEB CMS: Add action to hook
     *
     * @param  string  $tag The name of the filter to hook the $function_to_add callback to.
     * @param  callable  $callback The callback to be run when the filter is applied.
     * @param  int  $priority Optional. Used to specify the order in which the functions
     *                                  associated with a particular action are executed.
     *                                  Lower numbers correspond with earlier execution,
     *                                  and functions with the same priority are executed
     *                                  in the order in which they were added to the action. Default 20.
     * @param  int  $arguments Optional. The number of arguments the function accepts. Default 1.
     * @return void
     */
    function add_action(string $tag, callable $callback, int $priority = 20, int $arguments = 1): void
    {
        Hook::addAction($tag, $callback, $priority, $arguments);
    }
}

if (!function_exists('apply_filters')) {
    /**
     * JUZAWEB CMS: Apply filters to value
     *
     * @param  string  $tag The name of the filter hook.
     * @param mixed $value The value to filter.
     * @param mixed ...$args Additional parameters to pass to the callback functions.
     * @return mixed The filtered value after all hooked functions are applied to it.
     */
    function apply_filters(string $tag, mixed $value, ...$args): mixed
    {
        return Hook::filter($tag, $value, ...$args);
    }
}

if (!function_exists('add_filters')) {
    /**
     * @param  string  $tag The name of the filter to hook the $function_to_add callback to.
     * @param  callable  $callback The callback to be run when the filter is applied.
     * @param  int  $priority Optional. Used to specify the order in which the functions
     *                                  associated with a particular action are executed.
     *                                  Lower numbers correspond with earlier execution,
     *                                  and functions with the same priority are executed
     *                                  in the order in which they were added to the action. Default 20.
     * @param  int  $arguments Optional. The number of arguments the function accepts. Default 1.
     * @return void
     */
    function add_filters(string $tag, callable $callback, int $priority = 20, int $arguments = 1): void
    {
        Hook::addFilter($tag, $callback, $priority, $arguments);
    }
}
