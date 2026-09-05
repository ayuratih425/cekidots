<?php

namespace App\Traits;

trait HitungPredikat
{
    protected function getPredikat($capaian): array
    {
        if ($capaian === null || $capaian === '') {
            return ['label' => 'BELUM ADA', 'class' => 'belum-ada', 'icon' => 'fa-minus-circle'];
        }

        $capaian = (float) str_replace(',', '.', str_replace('.', '', $capaian));

        return match (true) {
            $capaian > 100 => ['label' => 'ISTIMEWA',        'class' => 'istimewa',        'icon' => 'fa-star'],
            $capaian >= 80 => ['label' => 'BAIK',            'class' => 'baik',            'icon' => 'fa-check-circle'],
            $capaian >= 60 => ['label' => 'BUTUH PERBAIKAN', 'class' => 'butuh-perbaikan', 'icon' => 'fa-exclamation-triangle'],
            $capaian >= 20 => ['label' => 'KURANG',          'class' => 'kurang',          'icon' => 'fa-times-circle'],
            $capaian > 0   => ['label' => 'SANGAT KURANG',   'class' => 'sangat-kurang',   'icon' => 'fa-exclamation-circle'],
            default        => ['label' => 'BELUM ADA',       'class' => 'belum-ada',       'icon' => 'fa-minus-circle'],
        };
    }
}
