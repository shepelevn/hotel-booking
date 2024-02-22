<?php

namespace App\Rules;

use Closure;
use DateInterval;
use DateTimeImmutable;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use LogicException;

class BeforeDays implements ValidationRule, DataAwareRule
{
    private DateTimeImmutable $startDate;
    private DateTimeImmutable $maxDate;

    public function __construct(private string $dateName, private int $days)
    {
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function setData(array $data): static
    {
        $startDateString = $data[$this->dateName];

        if (! is_string($startDateString)) {
            throw new LogicException('$startDate parameter is not string');
        }

        $this->startDate = new DateTimeImmutable($startDateString);
        $this->maxDate = $this->startDate->add(new DateInterval('P' . $this->days . 'D'));

        return $this;
    }

    /**
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!is_string($value) && !is_null($value)) {
            throw new LogicException('$value is not string or null');
        }

        if (! is_null($value)) {
            $inputDate = new DateTimeImmutable($value);

            if ($inputDate >= $this->maxDate) {
                /* TODO: Add pluralisation to translation of "days" */
                $fail(__('The dates interval must be less than :days days apart', ['days' => $this->days]));
            }
        }
    }
}
