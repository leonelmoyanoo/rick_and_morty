<?php

namespace Drupal\rick_and_morty\Service;

use Drupal\Core\Http\ClientFactory;
use Drupal\Component\Serialization\Json;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ConnectException;

/**
 * Create a service for consuming the openlibrary.org API
 */
class RickAndMortyService
{

  /**
   * Factory class for Client Class
   *
   * @var Drupal\Core\Http\ClientFactory
   */
  protected $clientFactory;


  /**
   * Constructor
   */
  public function __construct(
    ClientFactory $clientFactory,
  ) {
    $this->clientFactory = $clientFactory;
  }

  /**
   * Make a request to the API
   *
   * @return Array List of books. Null if there was an exception
   */
  public function request($get = NULL)
  {
    try {
      //Returns a GuzzleHttp/Client object | ConnectException
      $client = $this->clientFactory->fromOptions(['base_uri' => 'https://rickandmortyapi.com']);
      //Returns a GuzzleHttp/Psr7/Response object | GuzzleException
      $response = $client->get($get, []);
    } catch (RequestException $e) {
      dump($e);
      return null;
    } catch (GuzzleException $e) {
      dump($e);
      return null;
    } catch (ConnectException $e) {
      dump($e);
      return null;
    }
    //Select the GuzzleHttp/Psr7/Stream object from the Response object
    $body = $response->getBody();
    //Convert the Stream object into an array
    $data = Json::decode($body);
    return $data;
  }
}
