<?php

namespace Drupal\bibcite_organization_extras\Plugin\views\field;

use Drupal\Core\Database\Database;
use Drupal\views\Plugin\views\field\FieldPluginBase;
use Drupal\views\ResultRow;
use Drupal\views\Plugin\views\display\DisplayPluginBase;
use Drupal\views\ViewExecutable;
use Drupal\views\Views;

/**
 * A handler to provide a field that is completely custom by the administrator.
 * Looking to place category entered for the targetted profile per ref in list
 *
 * @ingroup views_field_handlers
 *
 * @ViewsField("orgx_ref_contribcat_delta")
 */
class OrgxRefContribcatDelta extends FieldPluginBase {

   /**
   * The current display.
   *
   * @var string
   *   The current display of the view.
   */
  protected $currentDisplay;

  public function __construct(array $configuration, $plugin_id, $plugin_definition) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
  }

  /**
   * {@inheritdoc}
   */
  public function init(ViewExecutable $view, DisplayPluginBase $display, array &$options = NULL) {
    parent::init($view, $display, $options);
    $this->currentDisplay = $view->current_display;
    $this->view = $view;
  }

    /**
   * @{inheritdoc}
   */
  public function query() {
    if ( $this->view->id() === 'contributor_orgx'  ||  $this->view->id() === 'yse_user_functions') {
      $author_table_alias = $this->findauthortable();
      $this->query->addField($author_table_alias, 'delta', 'orgx_ref_contribcat_delta');
    }
  }

  /**
   * @{inheritdoc}
   */
  public function render(ResultRow $values) {
    // Return the custom field value.  For now we will offer just the one string.  Later maybe expose the delta in a link.
    $outval = $values->orgx_ref_contribcat_delta;
    return $outval;
  }

  public function findauthortable(){
    foreach($this->query->tables as $top => $aliascountlist){
      foreach($aliascountlist as $t => $props){
        if ( $t === 'bibcite_reference__author' ){
          return $props['alias'];
        }
      }
    }
    return NULL;
  }
}