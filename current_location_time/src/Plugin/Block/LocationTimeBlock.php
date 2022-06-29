<?php
/**
 * @file
 * Contains \Drupal\article\Plugin\Block\ArticleBlock.
 */

namespace Drupal\current_location_time\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormInterface;

/**
 * Provides a 'Location & Time' block.
 *
 * @Block(
 *   id = "location_time_block",
 *   admin_label = @Translation("Get your current Location & Time"),
 *   category = @Translation("Custom")
 * )
 */
class LocationTimeBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    $html = "";
    $data = \Drupal::service('current_location_time.LocationService')->getLocation();
    $config = \Drupal::config('current_location_time.location_user');
    $country = $config->get('country');
	  $city = $config->get('city');
    $timezone = $config->get('timezone');
    $html = "<h2>Your Date/Time and Location details:</h2>";
    $html .= "<p><b>Country - </b>" . $country . "</p>";
    $html .= "<p><b>City - </b>" . $city . "</p>";
    $html .= "<p><b>Current Timezone - </b>" . $timezone . "</p>" . "<p><b> Current Date/Time - </b>" . $data . "</p>";


    return [
      '#markup' => $html,
      '#cache' => array(
        'tags' => [
          'TIME_USER'
        ]
      ),
    ];
  }
}