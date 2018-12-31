<?php

namespace Drupal\rsvp\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class RSVPRelationForm.
 */
class RSVPRelationForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $rsvp_relation = $this->entity;

    // RSVP entity ID.
    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $rsvp_relation->id(),
      '#machine_name' => [
        'exists' => '\Drupal\rsvp\Entity\RSVPRelation::load',
      ],
      '#disabled' => !$rsvp_relation->isNew(),
    ];

    // User ID.
    $form['uid'] = [
      '#type' => 'number',
      '#title' => $this->t('User ID'),
      '#description' => $this->t('The ID of the user who RSVP\'d for this event.'),
      '#default_value' => $rsvp_relation->getUid(),
      '#machine_name' => [
        'exists' => '\Drupal\rsvp\Entity\RSVPRelation::load',
      ],
      '#disabled' => !$rsvp_relation->isNew(),
      '#required' => TRUE,
    ];

    // Node ID.
    $form['nid'] = [
      '#type' => 'number',
      '#title' => $this->t('Node ID'),
      '#description' => $this->t('The ID of the event node.'),
      '#default_value' => $rsvp_relation->getNid(),
      '#machine_name' => [
        'exists' => '\Drupal\rsvp\Entity\RSVPRelation::load',
      ],
      '#disabled' => !$rsvp_relation->isNew(),
      '#required' => TRUE,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $rsvp_relation = $this->entity;
    $status = $rsvp_relation->save();

    // Add messages accordingly.
    switch ($status) {
      case SAVED_NEW:
        $messenger = \Drupal::messenger();
        $messenger->addMessage($this->t('You have successfully added %user\'s RSVP for %event',
          [
            '%user' => $this->entity->getUsername(),
            '%event' => $this->entity->getEventName(),
          ]
        ), $messenger::TYPE_WARNING);

        break;

      default:
        $messenger = \Drupal::messenger();
        $messenger->addMessage($this->t('You have successfully saved %user\'s RSVP for %event',
          [
            '%user' => $this->entity->getUsername(),
            '%event' => $this->entity->getEventName(),
          ]
        ), $messenger::TYPE_WARNING);

    }
    $form_state->setRedirectUrl($rsvp_relation->toUrl('collection'));
  }

}
