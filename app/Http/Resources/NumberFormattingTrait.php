<?php

namespace App\Http\Resources;

trait NumberFormattingTrait {

    // Функция для преобразования чисел в укороченный формат (1.2M, 3.4K и т.д.)
    protected function formatNumber($num)
    {
        $suffixes = ["", "K", "M", "B", "T"]; // Суффиксы для тысяч, миллионов, миллиардов и т.д.
        $suffixIndex = 0;

        while ($num >= 1000 && $suffixIndex < count($suffixes) - 1) {
            $num /= 1000;
            $suffixIndex++;
        }

        // Округляем число до одной десятой и добавляем суффикс
        return round($num, 1) . $suffixes[$suffixIndex];
    }
}
