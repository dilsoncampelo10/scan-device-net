<?php

namespace App\Helpers;

class DeviceHelper
{
    public static function getDeviceIcon($manufacturer): array
    {
        $manufacturer = strtolower($manufacturer ?? '');

        return match (true) {
            str_contains($manufacturer, 'apple')      => ['📱', 'iPhone/Mac'],
            str_contains($manufacturer, 'samsung')    => ['📱', 'Samsung'],
            str_contains($manufacturer, 'xiaomi')     => ['📱', 'Xiaomi'],
            str_contains($manufacturer, 'huawei')     => ['📱', 'Huawei'],
            str_contains($manufacturer, 'motorola')   => ['📱', 'Motorola'],
            str_contains($manufacturer, 'intel'),
            str_contains($manufacturer, 'lenovo'),
            str_contains($manufacturer, 'hp'),
            str_contains($manufacturer, 'dell'),
            str_contains($manufacturer, 'asus')       => ['💻', 'PC/Laptop'],
            str_contains($manufacturer, 'tp-link'),
            str_contains($manufacturer, 'cisco'),
            str_contains($manufacturer, 'ubiquiti')   => ['📶', 'Roteador'],
            default                                    => ['❓', 'Desconhecido'],
        };
    }
}
