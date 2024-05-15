<?php

declare(strict_types=1);

namespace App\Services;

use App\Domain\Enum\PromocodeType;
use App\Models\User;
use App\Repositories\PromocodeRepository;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class PromocodeService
{

    public function __construct(
        private PromocodeRepository $promocodeRepository,
    ) {}

    public function check(string $code): bool
    {
        $promocode
            = $this->promocodeRepository->getByCodeIsActiveNotUsed($code);

        return $promocode !== null;
    }

    /**
     * Activates a promocode for a user.
     *
     * @param  User  $user  The user to activate the promocode for.
     * @param  string  $code  The code of the promocode.
     * @param  PromocodeType  $type  The type of the promocode.
     *
     * @return bool Returns true if the promocode was activated successfully,
     *     otherwise false.
     * @throws \Illuminate\Validation\ValidationException If there are too many
     *     activation attempts.
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException If
     *     the promocode was not found.
     */
    public function activate(
        User $user,
        string $code,
        PromocodeType $type
    ): bool {
        $rateLimiterKey = 'activate-promocode-'.$user->id;

        if (RateLimiter::tooManyAttempts($rateLimiterKey, 1)) {
            throw ValidationException::withMessages([
                'access' => 'Слишком много попыток. Попробуйте через '
                    .ceil(RateLimiter::availableIn($rateLimiterKey) / 60)
                    .' минут',
            ]);
        }

        RateLimiter::increment($rateLimiterKey, 60 * 5);

        /** @var \App\Models\Promocode|null $promocode */
        $promocode
            = $this->promocodeRepository->getByCodeIsActiveNotUsed($code,
            $type);

        throw_if($promocode === null,
            new NotFoundHttpException('Нельзя применить промокод.'));

        $promocode->update([
            'user_id' => $user->id,
            'is_used' => true,
            'used_at' => now(),
        ]);

        return true;
    }

}