<?php

namespace Drupal\rsvp\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\rsvp\Entity\RSVPRelation;

/**
 * Class RSVPForm.
 */
class RSVPForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'rsvp_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('RSVP!'),
      '#description' => $this->t('Click to RSVP for this event.'),
      '#weight' => '0',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Retrieve details about current user and current event.
    $details = rsvp_retrieve_details();

    // Create RSVP relation.
    $relation = RSVPRelation::create([
      'id' => time(),
      'uid' => intval($details['uid']),
      'nid' => intval($details['nid']),
    ]);

    // Save RSVP relation.
    $relation->save();

    // Add message.
    $messenger = \Drupal::messenger();
    $messenger->addMessage($this->t('You have successfully RSVP\'d for %event',
      [
        '%event' => $relation->getEventName(),
      ]
    ), $messenger::TYPE_STATUS);
  }

}
