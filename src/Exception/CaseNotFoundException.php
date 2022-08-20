<?php // phpcs:disable

declare(strict_types=1);

namespace Bvsk\Contracts\Http\Request\Exception;

use ValueError;

class CaseNotFoundException extends ValueError
{

    /**
     * @param  class-string  $enum
     * @param  string  $case
     */
    public function __construct(string $enum, string $case)
    {
        parent::__construct(
            message: "Not found case for $enum::$case.",
        );
    }
}
