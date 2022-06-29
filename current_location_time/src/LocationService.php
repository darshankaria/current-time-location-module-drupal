<?php

namespace Drupal\current_location_time;

use Drupal\block\Entity\Block;
use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\Core\Datetime\DateFormatter;

/**
 * Class CustomService
 * @package Drupal\mymodule\Services
 */
class LocationService {

/**
* The Date Fromatter.
*
* @var Drupal\Core\Datetime\DateFormatter
*/
  protected $date_formatter;

/**
* Define constructor for string translation.
*/
  public function __construct(DateFormatter $date_formatter) {
    $this->date_formatter = $date_formatter;
}

/**
 * @return \Drupal\Component\Render\MarkupInterface|string
 */
  public function getLocation() {
	
	$config = \Drupal::config('current_location_time.location_user');

	//Get value from form
	$timezone = $config->get('timezone');

	$date_formatter = $this->date_formatter;
	$current_date = time();
	$dt = new DrupalDateTime();
	$dt->setTimezone(new \DateTimeZone(trim($timezone)));
	$dt->setTimestamp($current_date);
	
	$timestamp = $dt->format('jS M Y - g:i A');

	return $timestamp;
  }

}