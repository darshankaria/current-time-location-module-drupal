<?php
/**
 *  @file
 *  Contains \Drupal\rsvp_module\Form\RSVPForm
 */

namespace Drupal\current_location_time\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 *  Provides a form to get users time and location
 */
class LocationTimeForm extends ConfigFormBase {
   /**  
   * {@inheritdoc}  
   */  
  protected function getEditableConfigNames() {
    return [
      'current_location_time.location_user',
    ];
  }  

  /**  
   * {@inheritdoc}  
   */  
  public function getFormId() {
    return 'location_user';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('current_location_time.location_user');
    $form['country'] = array(
      '#title' => $this->t('Country'),
        '#type' => 'textfield',
        '#size' => 25,
        '#default_value' => $config->get('country'),
        '#required' => TRUE,
    );
    $form['city'] = array(
      '#title' => $this->t('City'),
      '#type' => 'textfield',
      '#size' => 25,
      '#default_value' => $config->get('city'),
      '#required' => TRUE,
    );
    $form['timezone'] = [
        '#type' => 'select',
        '#title' => $this->t('Timezone'),
        '#default_value' => $config->get('timezone'),
        '#options' => [
          'timezone_select' => '-- Select the timezone --',  
          'america/chicago' => 'America/Chicago',
          'america/new_York' => 'America/New_York',
          'asia/tokyo' => 'Asia/Tokyo',
          'asia/dubai' => 'Asia/Dubai',
          'asia/kolkata' => 'Asia/Kolkata',
          'europe/amsterdam' => 'Europe/Amsterdam',
          'europe/oslo' => 'Europe/Oslo',
          'europe/london' => 'Europe/London'
        ]
      ];
      return parent::buildForm($form, $form_state);
  }


  /**
  * (@inheritdoc)
  */
  public function submitForm(array &$form, FormStateInterface $form_state) {  
    parent::submitForm($form, $form_state);
    $this->config('current_location_time.location_user')
    ->set('country', $form_state->getValue('country'))
    ->set('city', $form_state->getValue('city'))
    ->set('timezone', $form_state->getValue('timezone'))
    ->save();
    \Drupal\Core\Cache\Cache::invalidateTags(array('TIME_USER'));
  }
}