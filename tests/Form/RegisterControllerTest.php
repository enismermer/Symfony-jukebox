<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class RegisterControllerTest extends TestCase
{
    public function testGreetsWithName(): void
    {
        $greeter = new RegisterControllerTest;

        $greeting = $greeter->greet('Alice');

        $this->assertSame('Hello, Alice!', $greeting);
    }
}