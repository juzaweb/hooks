<?php

namespace Juzaweb\Hooks;

use Laravel\SerializableClosure\Exceptions\PhpVersionNotSupportedException;
use Laravel\SerializableClosure\SerializableClosure;

class HashedCallable
{
    /**
     * @var \Closure
     */
    protected \Closure $callback;

    /**
     * @var string
     */
    protected string $signature;

    /**
     * @var string
     */
    protected string $id;

    /**
     * HashedCallable constructor.
     * @param \Closure $callback
     */
    public function __construct(\Closure $callback)
    {
        $this->callback = $callback;
        $this->id = $this->generateSignature();
    }

    /**
     * Generate a unique signature for the callback.
     *
     * @return string
     * @throws PhpVersionNotSupportedException
     */
    protected function generateSignature(): string
    {
        return base64_encode(
            serialize(
                new SerializableClosure($this->callback)
            )
        );
    }

    /**
     * Call the callback when the class is invoked
     * @return mixed
     */
    public function __invoke(): mixed
    {
        return call_user_func_array($this->getCallback(), func_get_args());
    }

    /**
     * Gets the signature
     * @return string
     */
    public function getSignature(): string
    {
        return $this->signature;
    }

    /**
     * Gets the callback
     * @return \Closure
     */
    public function getCallback(): \Closure
    {
        return $this->callback;
    }

    /**
     * Checks whether the provided HashedCallable matches this one
     * @param HashedCallable $callable
     * @return bool
     */
    public function is(self $callable): bool
    {
        return $callable->getSignature() === $this->getSignature();
    }
}
