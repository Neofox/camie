<?php

namespace App\Twig;

use App\Entity\Sheet;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class SheetTypeExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('sheetTypeToString', [$this, 'sheetTypeFromInt']),
            new TwigFilter('sheetTypeToInt', [$this, 'sheetTypeFromString']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('sheetTypetoString', [$this, 'sheetTypeFromInt']),
            new TwigFunction('sheetTypeToInt', [$this, 'sheetTypeFromString']),
        ];
    }

    /**
     * @param $value
     *
     * @return string
     */
    public function sheetTypeFromInt($value): string
    {
        $types = array_flip(Sheet::getAllTypes());
        $values = array_map(function ($str) {
            return substr($str, 5);
        }, $types);

        return $values[$value];
    }

    /**
     * @param $value
     *
     * @return int
     */
    public function sheetTypeFromString(string $value): int
    {
        return Sheet::getAllTypes()["TYPE_$value"];
    }
}
