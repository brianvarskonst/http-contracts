<?php // phpcs:disable

declare(strict_types=1);

namespace Bvsk\Contracts\Http\Request;

use ValueError;

enum Method
{
    case GET;
    case HEAD;
    case POST;
    case PUT;
    case PATCH;
    case DELETE;
    case CONNECT;
    case OPTIONS;
    case TRACE;

    public function name(): string
    {
        return match($this) {
            self::GET => 'GET',
            self::HEAD => 'HEAD',
            self::POST => 'POST',
            self::PUT => 'PUT',
            self::PATCH => 'PATCH',
            self::DELETE => 'DELETE',
            self::CONNECT => 'CONNECT',
            self::OPTIONS => 'OPTIONS',
            self::TRACE => 'TRACE',
        };
    }

    public static function fromName(string $name): Method
    {
        return self::tryFromName($name);
    }

    private static function tryFromName(string $name): Method
    {
        $name = strtoupper($name);
        $case = "self::$name";

        if (!defined($case)) {
            throw new ValueError(
                sprintf(
                    'Given name %s doesnt exists as a valid case for enum "%s"',
                    $name,
                    self::class
                )
            );
        }

        return constant($case);
    }
}
