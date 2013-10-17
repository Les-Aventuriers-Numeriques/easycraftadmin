<?php
/**
 * Méthodes statiques utilitaires pour l'application
 */
class EasyCraftAdmin {
  /**
   * Génération du fil d'ariane
   */
  public static function generateBreadcrumb($titles, $html_title = false) {
    $root = Slim::getInstance()->request()->getRootUri();

    if (empty($titles)) {
      if ($html_title) {
        return ' : Accueil';
      } else {
        return '<li><a href="'.$root.'/home">Accueil</a></li>';
      }
    }

    if ($html_title) {
      $return = ' : ';
    } else {
      $return = '<li><a href="'.$root.'/home">Accueil</a> <span class="divider">/</span></li>';
    }

    $i = 1;
    foreach ($titles as $route_name => $title) {
      if ($i == count($titles)) {
        $class = ' class="active"';
        $inner = $title;
      } else {
        $class = '';
        if (is_string($route_name)) {
          if ($html_title) {
            $inner = $title.' / ';
          } else {
            $inner = '<a href="'.$root.'/'.$route_name.'">'.$title.'</a> <span class="divider">/</span>';
          }
        } else {
          if ($html_title) {
            $inner = $title.' / ';
          } else {
            $inner = $title.' <span class="divider">/</span>';
          }
        }
      }

      if ($html_title) {
        $return .= $inner;
      } else {
        $return .= '<li'.$class.'>'.$inner.'</li>';
      }

      $i++;
    }

    return $return;
  }

  private static function getPlayerInventoryToPlace($type, $DataValues, $inv, $place_id) {
    switch($type) {
      case 'hand':
        return '';
      break;
      case 'inventory':
        if (!isset($inv[$type][$place_id])) {
          return '<img src="'.ROOT_URL.'img/items/noimage.png" />';
        }

        return '<img src="'.ROOT_URL.''.$DataValues->getImage($inv[$type][$place_id]['type'], $inv[$type][$place_id]['dataValue']).'" title="'.$DataValues->getLabel($inv[$type][$place_id]['type'], $inv[$type][$place_id]['dataValue']).'" />';
      break;
      case 'armor':
        if (empty($inv[$type][$place_id])) {
          return '<img src="'.ROOT_URL.'img/items/noimage.png" />';
        }

        return '<img src="'.ROOT_URL.''.$DataValues->getImage($inv[$type][$place_id]['type']).'" title="'.$DataValues->getLabel($inv[$type][$place_id]['type']).'" />';
      break;
    }
  }

  /**
   * Retourne un tableau HTML représentant l'inventaire d'un joueur
   */
  public static function getPlayerInventory($inv) {
    $DataValues = new DataValues();

    $return = '<table class="table table-bordered table-condensed"><tbody>'.
      '<tr>'.
        '<td>'.self::getPlayerInventoryToPlace('armor', $DataValues, $inv, 'helmet').'</td>'.
        '<td rowspan="5">&nbsp;</td>'.
        '<td>'.self::getPlayerInventoryToPlace('inventory', $DataValues, $inv, 9).'</td>'.
        '<td>'.self::getPlayerInventoryToPlace('inventory', $DataValues, $inv, 10).'</td>'.
        '<td>'.self::getPlayerInventoryToPlace('inventory', $DataValues, $inv, 11).'</td>'.
        '<td>'.self::getPlayerInventoryToPlace('inventory', $DataValues, $inv, 12).'</td>'.
        '<td>'.self::getPlayerInventoryToPlace('inventory', $DataValues, $inv, 13).'</td>'.
        '<td>'.self::getPlayerInventoryToPlace('inventory', $DataValues, $inv, 14).'</td>'.
        '<td>'.self::getPlayerInventoryToPlace('inventory', $DataValues, $inv, 15).'</td>'.
        '<td>'.self::getPlayerInventoryToPlace('inventory', $DataValues, $inv, 16).'</td>'.
        '<td>'.self::getPlayerInventoryToPlace('inventory', $DataValues, $inv, 17).'</td>'.
      '</tr>'.
      '<tr>'.
        '<td>'.self::getPlayerInventoryToPlace('armor', $DataValues, $inv, 'boots').'</td>'.
        '<td>'.self::getPlayerInventoryToPlace('inventory', $DataValues, $inv, 18).'</td>'.
        '<td>'.self::getPlayerInventoryToPlace('inventory', $DataValues, $inv, 19).'</td>'.
        '<td>'.self::getPlayerInventoryToPlace('inventory', $DataValues, $inv, 20).'</td>'.
        '<td>'.self::getPlayerInventoryToPlace('inventory', $DataValues, $inv, 21).'</td>'.
        '<td>'.self::getPlayerInventoryToPlace('inventory', $DataValues, $inv, 22).'</td>'.
        '<td>'.self::getPlayerInventoryToPlace('inventory', $DataValues, $inv, 23).'</td>'.
        '<td>'.self::getPlayerInventoryToPlace('inventory', $DataValues, $inv, 24).'</td>'.
        '<td>'.self::getPlayerInventoryToPlace('inventory', $DataValues, $inv, 25).'</td>'.
        '<td>'.self::getPlayerInventoryToPlace('inventory', $DataValues, $inv, 26).'</td>'.
      '</tr>'.
      '<tr>'.
        '<td>'.self::getPlayerInventoryToPlace('armor', $DataValues, $inv, 'leggings').'</td>'.
        '<td>'.self::getPlayerInventoryToPlace('inventory', $DataValues, $inv, 27).'</td>'.
        '<td>'.self::getPlayerInventoryToPlace('inventory', $DataValues, $inv, 28).'</td>'.
        '<td>'.self::getPlayerInventoryToPlace('inventory', $DataValues, $inv, 29).'</td>'.
        '<td>'.self::getPlayerInventoryToPlace('inventory', $DataValues, $inv, 30).'</td>'.
        '<td>'.self::getPlayerInventoryToPlace('inventory', $DataValues, $inv, 31).'</td>'.
        '<td>'.self::getPlayerInventoryToPlace('inventory', $DataValues, $inv, 32).'</td>'.
        '<td>'.self::getPlayerInventoryToPlace('inventory', $DataValues, $inv, 33).'</td>'.
        '<td>'.self::getPlayerInventoryToPlace('inventory', $DataValues, $inv, 34).'</td>'.
        '<td>'.self::getPlayerInventoryToPlace('inventory', $DataValues, $inv, 35).'</td>'.
      '</tr>'.
      '<tr>'.
        '<td>'.self::getPlayerInventoryToPlace('armor', $DataValues, $inv, 'chestplate').'</td>'.
        '<td colspan="9">&nbsp;</td>'.
      '</tr>'.
      '<tr>'.
        '<td></td>'.
        '<td>'.self::getPlayerInventoryToPlace('inventory', $DataValues, $inv, 0).'</td>'.
        '<td>'.self::getPlayerInventoryToPlace('inventory', $DataValues, $inv, 1).'</td>'.
        '<td>'.self::getPlayerInventoryToPlace('inventory', $DataValues, $inv, 2).'</td>'.
        '<td>'.self::getPlayerInventoryToPlace('inventory', $DataValues, $inv, 3).'</td>'.
        '<td>'.self::getPlayerInventoryToPlace('inventory', $DataValues, $inv, 4).'</td>'.
        '<td>'.self::getPlayerInventoryToPlace('inventory', $DataValues, $inv, 5).'</td>'.
        '<td>'.self::getPlayerInventoryToPlace('inventory', $DataValues, $inv, 6).'</td>'.
        '<td>'.self::getPlayerInventoryToPlace('inventory', $DataValues, $inv, 7).'</td>'.
        '<td>'.self::getPlayerInventoryToPlace('inventory', $DataValues, $inv, 8).'</td>'.
      '</tr>'.
    '</tbody></table>';

    return $return;
  }

  /**
   * Convertit les couleurs d'un texte MC au format HTML
   */
  public static function MCColorToHtml($text) {
    $count = 0;

    $search = array(
      CHAT_SELECTOR.'0',
      CHAT_SELECTOR.'1',
      CHAT_SELECTOR.'2',
      CHAT_SELECTOR.'3',
      CHAT_SELECTOR.'4',
      CHAT_SELECTOR.'5',
      CHAT_SELECTOR.'6',
      CHAT_SELECTOR.'7',
      CHAT_SELECTOR.'8',
      CHAT_SELECTOR.'9',
      CHAT_SELECTOR.'a',
      CHAT_SELECTOR.'b',
      CHAT_SELECTOR.'c',
      CHAT_SELECTOR.'d',
      CHAT_SELECTOR.'e',
      CHAT_SELECTOR.'f'
    );

    $replace_prefix = '<span style="color: #';
    $replace_suffix = '">';

    $replace = array(
      $replace_prefix.'000000'.$replace_suffix,
      $replace_prefix.'0300aa'.$replace_suffix,
      $replace_prefix.'02aa01'.$replace_suffix,
      $replace_prefix.'05aaaa'.$replace_suffix,
      $replace_prefix.'aa0000'.$replace_suffix,
      $replace_prefix.'aa00aa'.$replace_suffix,
      $replace_prefix.'cb8a09'.$replace_suffix,
      $replace_prefix.'aaaaaa'.$replace_suffix,
      $replace_prefix.'555555'.$replace_suffix,
      $replace_prefix.'5655ff'.$replace_suffix,
      $replace_prefix.'56ff56'.$replace_suffix,
      $replace_prefix.'57ffff'.$replace_suffix,
      $replace_prefix.'ff0000'.$replace_suffix,
      $replace_prefix.'ff55ff'.$replace_suffix,
      $replace_prefix.'ffff56'.$replace_suffix,
      $replace_prefix.'ffffff'.$replace_suffix
    );

    $text = str_replace($search, $replace, $text);

    return $text.str_repeat('</span>', $count);
  }
}
?>