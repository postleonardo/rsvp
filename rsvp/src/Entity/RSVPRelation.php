<?php

namespace Drupal\rsvp\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the RSVPRelation entity.
 *
 * @ConfigEntityType(
 *   id = "rsvp_relation",
 *   label = @Translation("RSVPRelation"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\rsvp\RSVPRelationListBuilder",
 *     "form" = {
 *       "add" = "Drupal\rsvp\Form\RSVPRelationForm",
 *       "edit" = "Drupal\rsvp\Form\RSVPRelationForm",
 *       "delete" = "Drupal\rsvp\Form\RSVPRelationDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\rsvp\RSVPRelationHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "rsvp_relation",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "uid" = "uid",
 *     "nid" = "nid",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/rsvp_relation/{rsvp_relation}",
 *     "add-form" = "/admin/structure/rsvp_relation/add",
 *     "edit-form" = "/admin/structure/rsvp_relation/{rsvp_relation}/edit",
 *     "delete-form" = "/admin/structure/rsvp_relation/{rsvp_relation}/delete",
 *     "collection" = "/admin/structure/rsvp_relation"
 *   }
 * )
 */
class RSVPRelation extends ConfigEntityBase implements RSVPRelationInterface {

  /**
   * The RSVPRelation ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The RSVPRelation uid.
   *
   * @var string
   */
  protected $uid;

  /**
   * The RSVPRelation nid.
   *
   * @var string
   */
  protected $nid;

  /**
   * Get user ID.
   *
   * @return int
   *  User ID.
   */
  public function getUid() {
    return $this->uid;
  }

  /**
   * Get node ID.
   *
   * @return int
   *  Node ID.
   */
  public function getNid() {
    return $this->nid;
  }

  /**
   * Get the username.
   *
   * @return string|null
   *  User's username.
   */
  public function getUserName() {
    $account = \Drupal\user\Entity\User::load($this->uid);
    $name = $account->getUsername();

    return $name;
  }

  /**
   * Get the user email.
   *
   * @return string|null
   *  The user's email.
   */
  public function getUserEmail() {
    $account = \Drupal\user\Entity\User::load($this->uid);
    $email = $account->getEmail();

    return $email;
  }

  /**
   * Get the event name.
   *
   * @return string|null
   *  The event name.
   */
  public function getEventName() {
    $node = \Drupal\node\Entity\Node::load($this->nid);
    $name = $node->getTitle();

    return $name;
  }
}
