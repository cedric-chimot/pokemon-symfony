<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use App\Service\ColorsService;

class ColorsExtension extends AbstractExtension
{
  private ColorsService $colorsService;

  public function __construct(ColorsService $colorsService)
  {
    $this->colorsService = $colorsService;
  }

  public function getFunctions(): array
  {
    return [
      new TwigFunction('type_color', [$this->colorsService, 'getTypeColor']),
      new TwigFunction('pokeball_color', [$this->colorsService, 'getPokeballColor']),
      new TwigFunction('sexe_color', [$this->colorsService, 'getSexeColor']),
      new TwigFunction('nature_color', [$this->colorsService, 'getNatureColor']),
      new TwigFunction('region_color', [$this->colorsService, 'getRegionColor']),
    ];
  }
}
