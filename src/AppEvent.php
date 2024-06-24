<?php

namespace Decahedron\AppEvents;

use Google\Protobuf\Internal\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Container\Container;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class AppEvent implements ShouldQueue
{
    use Queueable;

    const MAX_PAYLOAD_SIZE = 1024 * 1024; // 1 MB

    /**
     * @var string
     */
    public $event;

    /**
     * @var Message
     */
    public $payload;

    /**
     * Event constructor.
     *
     * @param string $event
     * @param        $payload
     */
    public function __construct(string $event, Message $payload, int $sizeLimit = null)
    {
        $sizeLimit = $sizeLimit ?? self::MAX_PAYLOAD_SIZE;

        if (strlen($payload->serializeToJsonString()) > $sizeLimit) {
            throw new \Exception('Payload size exceeds the limit of ' . $sizeLimit . ' bytes');
        }

        $this->onConnection('app-events');
        $this->payload = $payload;
        $this->event   = $event;
    }

    public function handle()
    {
        foreach (Config::get('app-events.handlers') as $event => $handler) {
            if ($this->event !== $event) {
                continue;
            }

            Container::getInstance()->make($handler)->handle($this->payload, $event);
        }
    }
}
