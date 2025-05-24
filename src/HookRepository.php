<?php

namespace Juzaweb\Hooks;

use Juzaweb\Hooks\Contracts\Hook;

class HookRepository implements Hook
{
    /**
     * Holds all registered actions.
     *
     * @var \Juzaweb\Hooks\Action
     */
    protected Action $action;

    /**
     * Holds all registered filters.
     *
     * @var \Juzaweb\Hooks\Filter
     */
    protected Filter $filter;

    /**
     * Construct the class.
     */
    public function __construct()
    {
        $this->action = new Action();
        $this->filter = new Filter();
    }

    /**
     * Get the action instance.
     *
     * @return \Juzaweb\Hooks\Action
     */
    public function getAction(): Action
    {
        return $this->action;
    }

    /**
     * Get the action instance.
     *
     * @return \Juzaweb\Hooks\Filter
     */
    public function getFilter(): Filter
    {
        return $this->filter;
    }

    /**
     * Add an action.
     *
     * @param  string  $hook      Hook name
     * @param mixed  $callback  Function to execute
     * @param  int  $priority  Priority of the action
     * @param  int  $arguments Number of arguments to accept
     */
    public function addAction(string $hook, mixed $callback, int $priority = 20, int $arguments = 1): void
    {
        $this->action->listen($hook, $callback, $priority, $arguments);
    }

    /**
     * Remove an action.
     *
     * @param  string  $hook     Hook name
     * @param mixed  $callback Function to execute
     * @param  int  $priority Priority of the action
     */
    public function removeAction(string $hook, mixed $callback, int $priority = 20): void
    {
        $this->action->remove($hook, $callback, $priority);
    }

    /**
     * Remove all actions.
     *
     * @param  string|null  $hook Hook name
     */
    public function removeAllActions(?string $hook = null): void
    {
        $this->action->removeAll($hook);
    }

    /**
     * Adds a filter.
     *
     * @param  string  $hook      Hook name
     * @param mixed  $callback  Function to execute
     * @param  int  $priority  Priority of the action
     * @param  int  $arguments Number of arguments to accept
     */
    public function addFilter(string $hook, mixed $callback, int $priority = 20, int $arguments = 1): void
    {
        $this->filter->listen($hook, $callback, $priority, $arguments);
    }

    /**
     * Remove a filter.
     *
     * @param  string  $hook     Hook name
     * @param mixed  $callback Function to execute
     * @param  int  $priority Priority of the action
     */
    public function removeFilter(string $hook, mixed $callback, int $priority = 20): void
    {
        $this->filter->remove($hook, $callback, $priority);
    }

    /**
     * Remove all filters.
     *
     * @param  string|null  $hook Hook name
     */
    public function removeAllFilters(string $hook = null): void
    {
        $this->filter->removeAll($hook);
    }

    /**
     * Set a new action.
     *
     * Actions never return anything. It is merely a way of executing code at a specific time in your code.
     *
     * You can add as many parameters as you'd like.
     *
     * @param string $action     Name of hook
     * @param mixed  $parameter1 A parameter
     * @param mixed  $parameter2 Another parameter
     *
     * @return void
     */
    public function action(): void
    {
        $args = func_get_args();
        $hook = $args[0];
        unset($args[0]);
        $args = array_values($args);
        $this->action->fire($hook, $args);
    }

    /**
     * Set a new filter.
     *
     * Filters should always return something. The first parameter will always be the default value.
     *
     * You can add as many parameters as you'd like.
     *
     * @param string $action     Name of hook
     * @param mixed  $value      The original filter value
     * @param mixed  $parameter1 A parameter
     * @param mixed  $parameter2 Another parameter
     *
     * @return mixed
     */
    public function filter(): mixed
    {
        $args = func_get_args();
        $hook = $args[0];
        unset($args[0]);
        $args = array_values($args);

        return $this->filter->fire($hook, $args);
    }

    public function allAction(): array
    {
        return $this->action->getListeners();
    }
}
