<?php

namespace Drupal\bibcite_organization_extras\Plugin\views\filter;

use Drupal\Core\Database\Database;
use Drupal\Core\Form\FormStateInterface;
use Drupal\views\Plugin\views\filter\StringFilter;
use Drupal\views\Plugin\views\filter\InOperator;
use Drupal\views\Plugin\views\display\DisplayPluginBase;
use Drupal\views\ViewExecutable;
use Drupal\views\Views;

/**
 * Filter by Reference Contributor Category values
 *
 * @ingroup views_filter_handlers
 *
 * @ViewsFilter("orgx_ref_contribcat_filter")
 */

class OrgxRefContribcatFilter extends InOperator {

  /**
   * {@inheritdoc}
   */
  public function init(ViewExecutable $view, DisplayPluginBase $display, array &$options = NULL) {
    parent::init($view, $display, $options);
    $this->valueTitle = t('YSE Contributor Status Options');
    $this->definition['options callback'] = array($this, 'generateOptions');
  }

  /**
   * Override the query so that no filtering takes place if the user doesn't
   * select any options.
   * NOT SURE WHY this is not picky about the table aliases as the fields are TODO
   */
  public function query() {
    if (!empty($this->value)) {
      parent::query();
    } elseif ( $this->view->id() === 'contributor_orgx' ||  $this->view->id() === 'yse_user_functions') {
        $this->query->addField('bibcite_reference__author', 'author_category', 'author_category');
    }
    
  }

  /**
   * Skip validation if no options have been chosen so we can use it as a
   * non-filter.
   */
  public function validate() {
    if (!empty($this->value)) {
      parent::validate();
    }
  }

  /**
   * Helper function that generates the options.
   * @return array
   */
  public function generateOptions() {
    // Array keys are used to compare with the table field values.
    // TODO: look these up from bibcite
    return array(
       'org_member_pending' => 'YSE Confirmation Pending',
    );
  }

}