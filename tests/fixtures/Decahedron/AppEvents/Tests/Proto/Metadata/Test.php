<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: tests/fixtures/Test.proto

namespace Decahedron\AppEvents\Tests\Proto\Metadata;

class Test
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
          return;
        }
        $pool->internalAddGeneratedFile(hex2bin(
            "0a8d010a1974657374732f66697874757265732f546573742e70726f746f" .
            "22170a0454657374120f0a076d657373616765180120012809424fca0220" .
            "44656361686564726f6e5c4170704576656e74735c54657374735c50726f" .
            "746fe2022944656361686564726f6e5c4170704576656e74735c54657374" .
            "735c50726f746f5c4d65746164617461620670726f746f33"
        ), true);

        static::$is_initialized = true;
    }
}

