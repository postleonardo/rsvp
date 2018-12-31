<?php

namespace Drupal\rsvp;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

/**
 * Provides a listing of RSVPRelation entities.
 */
class RSVPRelationListBuilder extends ConfigEntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['username'] = $this->t('User name');
    $header['user_email'] = $this->t('E-mail');
    $header['event_name'] = $this->t('Event');

    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['username'] = $entity->getUsername();
    $row['user_email'] = $entity->getUserEmail();
    $row['event_name'] = $entity->getEventName();

    return $row + parent::buildRow($entity);
  }

}
