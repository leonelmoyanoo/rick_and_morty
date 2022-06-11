<?php

namespace Drupal\rick_and_morty\Controller;

use Drupal\rick_and_morty\Service\RickAndMortyService;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class RickAndMortyController extends ControllerBase
{

  /**
   * Factory class for Client Class
   *
   * @var Drupal\rick_and_morty\Service\RickAndMortyService
   */
  protected $rickAndMortyService;
  public function __construct(RickAndMortyService $rickAndMortyService)
  {
    $this->rickAndMortyService = $rickAndMortyService;
  }
  public static function create(ContainerInterface $container)
  {
    return new static(
      $container->get('rick_and_morty.RickAndMortyService')
    );
  }


  public function myPage()
  {
    $get = '/api/character/[';
    for ($i = 0; $i < 5; $i++) {
      $get .= random_int(0, 671) . ',';
    }
    $get .= random_int(0, 671) . ']';
    $characters = $this->rickAndMortyService->request($get);
    foreach ($characters as $key => $value) {
      $url = explode('https://rickandmortyapi.com', $value['episode'][0]);
      $get = $url[1];
      $origin = $this->rickAndMortyService->request($get);
      $characters[$key]['chapter_origin'] = $origin;
    }
    return [
      '#theme' => 'rick_and_morty',
      '#characters' => $characters,
    ];
  }
}
