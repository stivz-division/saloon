<?php

namespace App\Rules\Client;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ClientAdvertisementDateTimeRule implements ValidationRule
{

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(
        string $attribute,
        mixed $value,
        Closure $fail
    ): void {
        $minDate = now();
        $maxDate = now()->addMonths(6);

        $date = \DateTime::createFromFormat('Y-m-d\TH:i', $value);

        if ($date < $minDate->toDateTime()
            || $date > $maxDate->toDateTime()
        ) {
            $fail('The date must be between '
                .$minDate->format('Y-m-d\TH:i').' and '
                .$maxDate->format('Y-m-d\TH:i'));
        }
    }

}
