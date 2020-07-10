<?php


namespace App\Exceptions;


use App\Utils\ViolationHelper;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Throwable;

class ValidationException extends \Exception
{
    /**
     * @var ConstraintViolationListInterface
     */
    private $violations;

    public function __construct(ConstraintViolationListInterface $violations, $message = "", $code = 0)
    {
        parent::__construct($message, $code);
        $this->violations = $violations;
    }

    public function getNormalizedViolations()
    {
        return ViolationHelper::normalizeViolations($this->violations);
    }
}