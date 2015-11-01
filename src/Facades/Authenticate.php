<?php namespace Nonoesp\Authenticate\Facades;
 
use Illuminate\Support\Facades\Facade;
 
class Authenticate extends Facade {
 
  /**
   * Get the registered name of the component.
   *
   * @return string
   */
  protected static function getFacadeAccessor() { return 'authenticate'; }
 
}