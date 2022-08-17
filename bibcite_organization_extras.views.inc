<?php

/**
 * @file
 * Contains views api functions for bibcite_organization_extras.
 */

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Database\Query\AlterableInterface;
use Drupal\field\FieldStorageConfigInterface;
use Drupal\bibcite_entity\Entity\ReferenceType;

/**
 * Implements hook_views_data_alter().
 */
function bibcite_organization_extras_views_data_alter(array &$data) {

  $data['bibcite_orgx']['table']['group'] = t('Views');
  $data['bibcite_orgx']['table']['join'] = [
    '#global' => [],
  ];

  $data['bibcite_orgx']['orgx_ref_contribcat'] = [
    'title' => t('Reference Contributor Org Category'),
    'help' => t('Contributor Org Relationship per Reference.'),
    'field' => [
      'id' => 'orgx_ref_contribcat',
    ],
  ];

    $data['bibcite_orgx']['orgx_ref_contribcat_delta'] = [
    'title' => t('Reference Contributor Org Category (author_category:delta)'),
    'help' => t('Position in record of Contributor Org Relationship per Reference.'),
    'field' => [
      'id' => 'orgx_ref_contribcat_delta',
    ],
  ];

  $data['bibcite_orgx']['orgx_ref_contribcat_filter'] = [
    'title' => t('Reference Contributor Org Category - Custom Filter'),
    'filter' => [
      'title' => t('Reference Contributor Org Category - Custom Filter'),
      'help' => t('Provides a custom filter for refs by chosen contributor Org status.'),
      'field' => 'author_category',
      'id' => 'orgx_ref_contribcat_filter',
    ],
  ];
}
