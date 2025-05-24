<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    larabizcom/larabiz
 * @author     The Anh Dang
 * @link       https://larabiz.com/cms
 * @license    GNU V2
 */

namespace Juzaweb\Hooks\Contracts;

interface Hook
{
    public function getAction();

    public function getFilter();

    public function addAction(string $hook, mixed $callback, int $priority = 20, int $arguments = 1);

    public function removeAction(string $hook, mixed $callback, int $priority = 20);

    public function removeAllActions(?string $hook = null): void;

    public function addFilter(string $hook, mixed $callback, int $priority = 20, int $arguments = 1);

    public function removeFilter(string $hook, mixed $callback, int $priority = 20);

    public function removeAllFilters(?string $hook = null);

    public function filter(): mixed;

    public function action(): void;

    public function allAction(): array;
}
