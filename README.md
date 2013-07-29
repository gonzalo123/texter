# Texter

PHP testing framework inspired in Jasmine. It doesn't provides a new assertion or mocking frameworks. It uses PHPUnit assertions.

### Example:

```php
class StringCalculator
{
    public function add($string)
    {
        return (int)array_sum(explode(",", $string));
    }
}

$stringCalculator = new StringCalculator;

describe("add mull returns zero", function () use ($stringCalculator) {
        assertEquals(null, $stringCalculator->add(""));
    });

describe(
    "add number returns number",
    function ($expected, $actual, $message) use ($stringCalculator) {
        assertEquals($expected, $stringCalculator->add($actual), $message);
    }, [
        ['expected' => 1, 'actual' => "1", 'message' => 'add 1'],
        ['expected' => 2, 'actual' => "2", 'message' => 'add 1'],
        ['expected' => 10, 'actual' => "10", 'message' => 'add 10'],
    ]);

describe("1,1 should return 2", function () use ($stringCalculator) {
        assertEquals(2, $stringCalculator->add("1,1"));
    });

```

### Mocking example

If you can use mocks you need to use external mocking frameworks such as Mockery:
```php
class Temperature
{

    public function __construct($service)
    {
        $this->_service = $service;
    }

    public function average()
    {
        $total = 0;
        for ($i=0;$i<3;$i++) {
            $total += $this->_service->readTemp();
        }
        return $total/3;
    }
}

$service = m::mock('service');

describe("testing mocks with mockery", function() use ($service) {
        $service->shouldReceive('readTemp')->andReturn(11, 12, 13);
        $temperature = new Temperature($service);
        assertEquals(12, $temperature->average(), "dummy message");
    });
```

### How to run our tests

```
php ./bin/console.php texter:run ./tests
```

### Warning

That's a proof of concepts. It's not an stable library. There're a lot of remaining things.