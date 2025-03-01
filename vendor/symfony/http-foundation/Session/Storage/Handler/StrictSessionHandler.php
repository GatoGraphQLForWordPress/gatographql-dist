<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace GatoExternalPrefixByGatoGraphQL\Symfony\Component\HttpFoundation\Session\Storage\Handler;

/**
 * Adds basic `SessionUpdateTimestampHandlerInterface` behaviors to another `SessionHandlerInterface`.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 * @internal
 */
class StrictSessionHandler extends AbstractSessionHandler
{
    /**
     * @var \SessionHandlerInterface
     */
    private $handler;
    /**
     * @var bool
     */
    private $doDestroy;
    public function __construct(\SessionHandlerInterface $handler)
    {
        if ($handler instanceof \SessionUpdateTimestampHandlerInterface) {
            throw new \LogicException(\sprintf('"%s" is already an instance of "SessionUpdateTimestampHandlerInterface", you cannot wrap it with "%s".', \get_debug_type($handler), self::class));
        }
        $this->handler = $handler;
    }
    /**
     * Returns true if this handler wraps an internal PHP session save handler using \SessionHandler.
     *
     * @internal
     */
    public function isWrapper() : bool
    {
        return $this->handler instanceof \SessionHandler;
    }
    public function open(string $savePath, string $sessionName) : bool
    {
        parent::open($savePath, $sessionName);
        return $this->handler->open($savePath, $sessionName);
    }
    protected function doRead(string $sessionId) : string
    {
        return $this->handler->read($sessionId);
    }
    public function updateTimestamp(string $sessionId, string $data) : bool
    {
        return $this->write($sessionId, $data);
    }
    protected function doWrite(string $sessionId, string $data) : bool
    {
        return $this->handler->write($sessionId, $data);
    }
    public function destroy(string $sessionId) : bool
    {
        $this->doDestroy = \true;
        $destroyed = parent::destroy($sessionId);
        return $this->doDestroy ? $this->doDestroy($sessionId) : $destroyed;
    }
    protected function doDestroy(string $sessionId) : bool
    {
        $this->doDestroy = \false;
        return $this->handler->destroy($sessionId);
    }
    public function close() : bool
    {
        return $this->handler->close();
    }
    /**
     * @return int|false
     */
    public function gc(int $maxlifetime)
    {
        return $this->handler->gc($maxlifetime);
    }
}
