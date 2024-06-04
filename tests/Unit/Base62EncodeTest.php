<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Traits\Shortener;
use Random\RandomException;

class Base62EncodeTest extends TestCase
{
    use Shortener;

    /**
     * @throws RandomException
     */
    public function testBase62Encode()
    {

        // Test for small numbers
        $this->assertEquals('1', $this->base62_encode(1)[0]);
        $this->assertEquals('z', $this->base62_encode(35)[0]);
        $this->assertEquals('A', $this->base62_encode(36)[0]);
        $this->assertEquals('Z', $this->base62_encode(61)[0]);

        // Test for a larger number
        $this->assertEquals('10', substr($this->base62_encode(62), 0, 2));

        // Test for ensuring length is at least 6
        $encoded = $this->base62_encode(12345);
        $this->assertTrue(strlen($encoded) >= 6);
        $this->assertMatchesRegularExpression('/^[0-9a-zA-Z]{6,}$/', $encoded);
    }

    /**
     * @throws RandomException
     */
    public function testLength()
    {
        $encoded = $this->base62_encode(12345);
        $this->assertTrue(strlen($encoded) >= 6);
    }
}
