<?php

namespace App\Twig;

use Twig\TwigFilter;
use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;
use App\Repository\ActualityRepository;


class TwigExtension extends AbstractExtension
{
    private $actuRepo;


    public function __construct(ActualityRepository $actuRepo)
    {
        $this->actuRepo = $actuRepo;
    }

    public function getFilters()
    {
        return [
            new TwigFilter('truncate', [$this, 'truncate']),
        ];
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('addClass', [$this, 'addClassActive']),
            new TwigFunction('last_actu', [$this, 'displayTwoLastActu']),
        ];
    }

    public function addClassActive(string $actualRoute, string $route, string $content = 'active')
    {
        if ($actualRoute === $route) {
            return $content;
        }
    }

    public function displayTwoLastActu()
    {
        return $this->actuRepo->findBy([], ['id' => 'DESC'], 2, 0);
    }


    public function truncate(string $content, int $limit = 50, int $start = 0)
    {
        if (strlen($content) <= $limit || !strpos($content, ' ', $limit)) {
            return $content;
        }
        $lastSpace = strpos($content, ' ', $limit);
        return substr($content, $start, $lastSpace) . '...';
    }
}
