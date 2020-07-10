<?php


namespace App\RequestConstraints;

use Symfony\Component\Validator\Constraints as Assert;
use App\Validator as MyAssert;

class UserRestConstraint
{
    public static function getPostMethodConstraint()
    {
        return new Assert\Collection([
            'fields' => [
                'name' => [
                    new Assert\NotBlank([
                        'message' => "field can't be blank"
                    ]),
                    new Assert\Regex([
                        'message' => 'field must be in arabic alphabet',
                        'pattern' => '/^[a-z ,.\'-]+$/i'
                    ])
                ],
                'surname' => [
                    new Assert\NotBlank([
                        'message' => "field can't be blank"
                    ]),
                    new Assert\Regex([
                        'message' => 'field must be in arabic alphabet',
                        'pattern' => '/^[a-z ,.\'-]+$/i'
                    ])
                ],
                'age' => [
                    new Assert\NotBlank([
                        'message' => "field can't be blank"
                    ]),
                    new Assert\Type([
                        'message' => 'field must be an integer',
                        'type' => 'integer'
                    ])
                ],
                'phoneNumber' => [
                    new Assert\NotBlank([
                        'message' => "field can't be blank"
                    ]),
                    new Assert\Regex([
                        'message' => 'Phone number format must be valid',
                        'pattern' => '/(([+][(]?[0-9]{1,3}[)]?)|([(]?[0-9]{4}[)]?))\s*[)]?[-\s\.]?[(]?[0-9]{1,3}[)]?([-\s\.]?[0-9]{3})([-\s\.]?[0-9]{3,4})/i'
                    ])
                ],
                'email' => [
                    new Assert\NotBlank([
                        'message' => 'field can\'t be blank'
                    ]),
                    new Assert\Email([
                        'message' => 'Email must be valid'
                    ])
                ],
                'password' => [
                    new Assert\NotBlank([
                        'message' => 'field can\'t be blank'
                    ]),
                    new Assert\Type([
                        'message' => 'field must be a string',
                        'type' => 'string',
                    ]),
                    new Assert\Length([
                        'minMessage' => 'Password must be at least 6 character long',
                        'min' => 6
                    ])
                ],
                'hourlyRate' => [
                    new Assert\NotBlank([
                        'message' => 'field can\'t be blank'
                    ]),
                    new Assert\Positive([
                        'message' => 'Hourly Rate must be positive number'
                    ]),
                    new Assert\Type([
                        'message' => 'field must be a numeric value',
                        'type' => 'numeric'
                    ]),
                    new MyAssert\NumberScale([
                        'message' => 'Hourly Rate can have maximum 2 decimals',
                        'scale' => 2
                    ])
                ],
            ],
        ]);
    }

    public static function getPutMethodConstraint()
    {
        return new Assert\Collection([
            'allowMissingFields' => true,
            'fields' => [
                'name' => [
                    new Assert\NotBlank([
                        'message' => "field can't be blank"
                    ]),
                    new Assert\Regex([
                        'message' => 'field must be in arabic alphabet',
                        'pattern' => '/^[a-z ,.\'-]+$/i'
                    ])
                ],
                'surname' => [
                    new Assert\NotBlank([
                        'message' => "field can't be blank"
                    ]),
                    new Assert\Regex([
                        'message' => 'field must be in arabic alphabet',
                        'pattern' => '/^[a-z ,.\'-]+$/i'
                    ])
                ],
                'age' => [
                    new Assert\NotBlank([
                        'message' => "field can't be blank"
                    ]),
                    new Assert\Type([
                        'message' => 'field must be an integer',
                        'type' => 'integer'
                    ])
                ],
                'phoneNumber' => [
                    new Assert\NotBlank([
                        'message' => "field can't be blank"
                    ]),
                    new Assert\Regex([
                        'message' => 'Phone number format must be valid',
                        'pattern' => '/(([+][(]?[0-9]{1,3}[)]?)|([(]?[0-9]{4}[)]?))\s*[)]?[-\s\.]?[(]?[0-9]{1,3}[)]?([-\s\.]?[0-9]{3})([-\s\.]?[0-9]{3,4})/i'
                    ])
                ],
                'email' => [
                    new Assert\NotBlank([
                        'message' => 'field can\'t be blank'
                    ]),
                    new Assert\Email([
                        'message' => 'Email must be valid'
                    ])
                ],
                'password' => [
                    new Assert\NotBlank([
                        'message' => 'field can\'t be blank'
                    ]),
                    new Assert\Type([
                        'message' => 'field must be a string',
                        'type' => 'string',
                    ]),
                    new Assert\Length([
                        'minMessage' => 'Password must be at least 6 character long',
                        'min' => 6
                    ])
                ],
                'hourlyRate' => [
                    new Assert\NotBlank([
                        'message' => 'field can\'t be blank'
                    ]),
                    new Assert\Positive([
                        'message' => 'Hourly Rate must be positive number'
                    ]),
                    new Assert\Type([
                        'message' => 'field must be a numeric value',
                        'type' => 'numeric'
                    ]),
                    new MyAssert\NumberScale([
                        'message' => 'Hourly Rate can have maximum 2 decimals',
                        'scale' => 2
                    ])
                ],
            ],
        ]);
    }
}