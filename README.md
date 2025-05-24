## About
Add Actions and filters in Laravel like WordPress.

## Installation
- Install using Composer
```
composer require juzaweb/hooks
```

## Usage
Anywhere in your code you can create a new action like so:
```
do_action($tag, ...$args)
```

```
 * TAD CMS: Do action hook
 * @param string $tag Action / Hook name (E.x: my.hook)
 * @param mixed ...$args Additional parameters to pass to the callback functions.
 * @return void
```

Add action
To listen to your hooks, you attach listeners. These are best added to your ``AppServiceProvider boot()`` method.
```
add_action($tag, $callback, $priority = 20, $arguments = 1)
```

```
 * Add action to hook
 * @param string $tag The name of the filter to hook the $function_to_add callback to.
 * @param callable $callback The callback to be run when the filter is applied.
 * @param int $priority Optional. Used to specify the order in which the functions
 *                                  associated with a particular action are executed.
 *                                  Lower numbers correspond with earlier execution,
 *                                  and functions with the same priority are executed
 *                                  in the order in which they were added to the action. Default 20.
 * @param int $arguments Optional. The number of arguments the function accepts. Default 1.
 * @return void
```

Apply filters
```
apply_filters($tag, $value, ...$args)
```

```
 * TAD CMS: Apply filters to value
 * @param string $tag The name of the filter hook.
 * @param mixed  $value The value to filter.
 * @param mixed  ...$args Additional parameters to pass to the callback functions.
 * @return mixed The filtered value after all hooked functions are applied to it.
```

Add filters
To listen to your hooks, you attach listeners. These are best added to your ``AppServiceProvider boot()`` method.
```
add_filters($tag, $callback, $priority = 20, $arguments = 1)
```

```
  * @param string $tag The name of the filter to hook the $function_to_add callback to.
  * @param callable $callback The callback to be run when the filter is applied.
  * @param int $priority Optional. Used to specify the order in which the functions
  *                                  associated with a particular action are executed.
  *                                  Lower numbers correspond with earlier execution,
  *                                  and functions with the same priority are executed
  *                                  in the order in which they were added to the action. Default 20.
  * @param int $arguments   Optional. The number of arguments the function accepts. Default 1.
  * @return bool
```

## Using in Blade
Adding the same action as the one in the action example above:
```
@do_action('my.hook', $user)
```

Adding the same filter as the one in the filter example above:
```
You are @apply_filters('my.hook', 'awesome')
```