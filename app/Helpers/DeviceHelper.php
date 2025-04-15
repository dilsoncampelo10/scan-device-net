<?php

namespace App\Helpers;

class DeviceHelper
{
    public static function getDeviceIcon($manufacturer): array
    {
        $manufacturer = strtolower($manufacturer ?? '');

        return match (true) {
            str_contains($manufacturer, 'apple')      => ['fa-solid fa-mobile-screen', 'iPhone/Mac'],
            str_contains($manufacturer, 'samsung')    => ['fa-solid fa-mobile-screen', 'Samsung'],
            str_contains($manufacturer, 'xiaomi')     => ['fa-solid fa-mobile-screen', 'Xiaomi'],
            str_contains($manufacturer, 'huawei')     => ['fa-solid fa-mobile-screen', 'Huawei'],
            str_contains($manufacturer, 'motorola')   => ['fa-solid fa-mobile-screen', 'Motorola'],
            str_contains($manufacturer, 'intel'),
            str_contains($manufacturer, 'lenovo'),
            str_contains($manufacturer, 'hp'),
            str_contains($manufacturer, 'dell'),
            str_contains($manufacturer, 'asus')       => ['fa-solid fa-laptop', 'PC/Laptop'],
            str_contains($manufacturer, 'tp-link'),
            str_contains($manufacturer, 'cisco'),
            str_contains($manufacturer, 'ubiquiti')   => ['fa-solid fa-wifi', 'Roteador'],
            default                                    => ['fa-solid fa-question', 'Desconhecido'],
        };
    }
}
