<?php

namespace Drupal\rsvp\Form;

use Drupal\Core\Entity\EntityConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Builds the form to delete RSVPRelation entities.
 */
class RSVPRelationDeleteForm extends EntityConfirmFormBase {

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return $this->t('Are you sure you want to delete %user\'s RSVP for %event?', [
      '%user' => $this->entity->getUsername(),
      '%event' => $this->entity->getEventName(),
    ]);
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl() {
    return new Url('entity.rsvp_relation.collection');
  }

  /**
   * {@inheritdoc}
   */
  public function getConfirmText() {
    return $this->t('Delete');
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->entity->delete();

    // Add message.
    $messenger = \Drupal::messenger();
    $messenger->addMessage($this->t('You have successfully deleted %user\'s RSVP for %event',
      [
        '%user' => $this->entity->getUsername(),
        '%event' => $this->entity->getEventName(),
      ]
    ), $messenger::TYPE_STATUS);

    // Redirect.
    $form_state->setRedirectUrl($this->getCancelUrl());
  }

}
