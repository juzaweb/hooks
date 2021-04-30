<?php

use Tadcms\Hooks\Facades\Events as Hook;

/**
 * TAD CMS: Do action hook
 * @param string $tag
 * @param mixed ...$args Additional parameters to pass to the callback functions.
 * @return void
 * */
function do_action($tag, ...$args) {
    Hook::action($tag, $args);
}

/**
 * TAD CMS: Add action to hook
 * @param string $tag The name of the filter to hook the $function_to_add callback to.
 * @param callable $callback The callback to be run when the filter is applied.
 * @param int $priority Optional. Used to specify the order in which the functions
 *                                  associated with a particular action are executed.
 *                                  Lower numbers correspond with earlier execution,
 *                                  and functions with the same priority are executed
 *                                  in the order in which they were added to the action. Default 20.
 * @param int $arguments Optional. The number of arguments the function accepts. Default 1.
 * @return void
 */
function add_action($tag, $callback, $priority = 20, $arguments = 1) {
    Hook::addAction($tag, $callback, $priority, $arguments);
}

/**
 * TAD CMS: Apply filters to value
 * @param string $tag The name of the filter hook.
 * @param mixed  $value The value to filter.
 * @param mixed  ...$args Additional parameters to pass to the callback functions.
 * @return mixed The filtered value after all hooked functions are applied to it.
 */
function apply_filters($tag, $value, ...$args) {
    return Hook::filter($tag, $value, $args);
}

/**
 * @param string $tag The name of the filter to hook the $function_to_add callback to.
 * @param callable $callback The callback to be run when the filter is applied.
 * @param int $priority Optional. Used to specify the order in which the functions
 *                                  associated with a particular action are executed.
 *                                  Lower numbers correspond with earlier execution,
 *                                  and functions with the same priority are executed
 *                                  in the order in which they were added to the action. Default 20.
 * @param int $arguments   Optional. The number of arguments the function accepts. Default 1.
 * @return bool
 */
function add_filters($tag, $callback, $priority = 20, $arguments = 1) {
    return Hook::addFilter($tag, $callback, $priority, $arguments);
}