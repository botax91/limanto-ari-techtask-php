<?php
namespace App\Tests;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
/**
 * Description of LunchController
 *
 * @author reachusolutions
 */
class RecipeTest extends WebTestCase{
  
  /**
   * @dataProvider urlProvider
   */
  public function testPageIsSuccessful($url)
  {
    $client = self::createClient();
    $client->request('GET', $url);

    $this->assertTrue($client->getResponse()->isSuccessful());
  }
  
  public function urlProvider()
  {
    yield ['/'];
  }
  
  /**
   * @dataProvider urlProvider
   */
  public function testLunchList($url){
    $client = self::createClient();
    $client->request('GET', $url);
    
    $this->assertArrayHasKey('recipes', json_decode($client->getResponse()->getContent(), true));
  }
  
}
