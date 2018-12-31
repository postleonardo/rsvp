<?php

namespace Drupal\rsvp\Entity;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Provides an interface for defining RSVPRelation entities.
 */
interface RSVPRelationInterface extends ConfigEntityInterface {
  /**
   * Get the user ID.
   *
   * @return int|null
   *   The user ID, or NULL if the object does not yet have a
   *   user ID.
   */
  public function getUid();

  /**
   * Get the node ID.
   *
   * @return int|null
   *   The node ID, or NULL if the object does not yet have a
   *   node ID.
   */
  public function getNid();

  /**
   * Get the username.
   *
   * @return string|null
   *    The username, or NULL if the object does not yet have a
   *    username.
   */
  public function getUsername();

  /**
   * Get the user's email.
   *
   * @return string|null
   *    The user's email, or NULL if the object does not yet have a
   *    user email.
   */
  public function getUserEmail();

  /**
   * Get the event name.
   *
   * @return string|null
   *    The event name, or NULL if the object does not yet have a
   *    event name.
   */
  public function getEventName();
}
