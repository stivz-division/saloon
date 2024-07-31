<?php

declare(strict_types=1);

namespace App\Services;

use App\Domain\Enum\AdvertisementTopTariffsType;
use App\Models\AdvertisementTopTariff;
use App\Models\MasterAdvertisement;

final class AdvertisementTopTariffService
{

    public function setTariff(
        MasterAdvertisement $masterAdvertisement,
        AdvertisementTopTariff $tariff
    ): void {
        $masterAdvertisement->update([
            'advertisement_top_tariff_id' => $tariff->id,
            'set_top_tariff_at'           => now(),
        ]);
    }

    public function raise()
    {
        MasterAdvertisement::query()
            ->with(['advertisementTopTariff'])
            ->has('advertisementTopTariff')
            ->lazy()
            ->each(function (MasterAdvertisement $advertisement) {
                if ($this->checkActualTariff($advertisement) === false) {
                    return;
                }

                $type = $advertisement->advertisementTopTariff->type;

                if ($type === AdvertisementTopTariffsType::Minute) {
                    $this->minuteHandler($advertisement);

                    return;
                }

                if ($type === AdvertisementTopTariffsType::ConcreteTime) {
                    $this->currentTimeHandler($advertisement);

                    return;
                }
            });
    }

    private function checkActualTariff(MasterAdvertisement $advertisement): bool
    {
        $countDays = $advertisement->advertisementTopTariff->count_days;

        $diffDays = $advertisement->set_top_tariff_at->diffInDays(now());

        if ($diffDays > $countDays) {
            $advertisement->update([
                'advertisement_top_tariff_id' => null,
                'set_top_tariff_at'           => null,
            ]);

            return false;
        }

        return true;
    }

    private function minuteHandler(MasterAdvertisement $advertisement): void
    {
        $diffInMinutes = $advertisement->top_at->diffInMinutes(now());

        if ($diffInMinutes >= $advertisement->advertisementTopTariff->minutes) {
            $advertisement->update([
                'top_at' => now(),
            ]);
        }
    }

    private function currentTimeHandler(MasterAdvertisement $advertisement
    ): void {
        if ($advertisement->advertisementTopTariff->start_time
            === now()->toTimeString()
        ) {
            $advertisement->update([
                'top_at' => now(),
            ]);
        }
    }

}