<?php

use Texter\Error;

describe("Testing real exceptions", function () {
        try {
            assertEquals(1, 2, "Custom Error");
        } catch (\Exception $e) {
            $error = new Error("Testing errors", $e);

            assertEquals("Testing errors", $error->getName());
            assertInstanceOf('Exception', $error->getException());
            assertEquals(__FILE__, $error->getFile());
            assertEquals(7, $error->getLine());
            assertEquals("Custom Error\nFailed asserting that 2 matches expected 1.", $error->getMessage());
        }
    });

describe("Testing data providers", function ($expected, $actual, $message) {
        try {
            assertEquals($expected, $actual, $message);
        } catch (\Exception $e) {
            $error = new Error("Testing errors {$message}", $e);

            assertEquals("Testing errors {$message}", $error->getName());
            assertInstanceOf('Exception', $error->getException());
            assertEquals(__FILE__, $error->getFile());
            assertEquals(21, $error->getLine());
            assertEquals("message\nFailed asserting that 2 matches expected 1.", $error->getMessage());
            assertEquals(['expected' => 1, 'actual' => 2, 'message' => 'message'], $error->getParameters());
        }
    }, [
        ['expected' => 1, 'actual' => 2, 'message' => 'message'],
    ]);