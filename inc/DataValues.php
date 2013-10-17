<?php
/**
 * Classe représentant les DataValues de Minecraft
 */
class DataValues {
  /**
   * La liste des DataValues sous forme de tableau
   */
  private $data_values = array();

  public function __construct() {
    // Ajout des DataValues de Minecraft
    $this->add('1;;Pierre');
    $this->add('2;;Herbe');
    $this->add('3;;Terre');
    $this->add('4;;Pierre taillée');

    $this->add('5;0;Planche');
    $this->add('5;1;Planche d\'épicéa');
    $this->add('5;2;Planche de bouleau');
    $this->add('5;3;Planche tropicale');

    $this->add('6;0;Pousse d\'arbre normal');
    $this->add('6;1;Pousse d\'arbre foncé');
    $this->add('6;2;Pousse d\'arbre clair');
    $this->add('6;3;Pousse d\'arbre brum');

    $this->add('7;;Bedrock');
    $this->add('8;;Eau');
    $this->add('9;;Eau stationnaire');
    $this->add('10;;Lave');
    $this->add('11;;Lave stationnaire');
    $this->add('12;;Sable');
    $this->add('13;;Gravier');
    $this->add('14;;Minerai d\'or');
    $this->add('15;;Minerai de fer');
    $this->add('16;;Minerai de charbon');

    $this->add('17;0;Bois');
    $this->add('17;1;Bois épicéa');
    $this->add('17;2;Bois bouleau');
    $this->add('17;3;Bois tropical');

    $this->add('18;0;Feuillage');
    $this->add('18;1;Feuillage');
    $this->add('18;2;Feuillage');
    $this->add('18;3;Feuillage');

    $this->add('19;;Eponge');
    $this->add('20;;Verre');
    $this->add('21;;Minerai de lapis-lazuli');
    $this->add('22;;Bloc de lapis-lazuli');
    $this->add('23;;Distributeur');

    $this->add('24;0;Grès');
    $this->add('24;1;Grès clair');
    $this->add('24;2;Grès clair brut');

    $this->add('25;;Bloc musical');
    $this->add('26;;Lit');
    $this->add('27;;Rails de propulsion');
    $this->add('28;;Rails de détection');
    $this->add('29;;Piston collant');
    $this->add('30;;Toile d\'arraignée');

    $this->add('31;0;Herbes hautes');
    $this->add('31;1;Herbes hautes');
    $this->add('31;2;Herbes hautes');

    $this->add('32;;Arbuste mort');

    $this->add('33;;Piston');
    $this->add('34;;Tige de piston');

    $this->add('35;0;Laine blanche');
    $this->add('35;1;Laine orange');
    $this->add('35;2;Laine violette claire');
    $this->add('35;3;Laine bleu claire');
    $this->add('35;4;Laine jaune');
    $this->add('35;5;Laine verte claire');
    $this->add('35;6;Laine rose');
    $this->add('35;7;Laine noir claire');
    $this->add('35;8;Laine grise');
    $this->add('35;9;Laine cyan');
    $this->add('35;10;Laine violette foncée');
    $this->add('35;11;Laine bleu claire');
    $this->add('35;12;Laine brune');
    $this->add('35;13;Laine verte foncée');
    $this->add('35;14;Laine rouge');
    $this->add('35;15;Laine noire');

    $this->add('36;;Block déplacé par un piston');
    $this->add('37;;Pissenlit');
    $this->add('38;;Rose');
    $this->add('39;;Champignon brum');
    $this->add('40;;Champignon rouge');
    $this->add('41;;Bloc d\'or');
    $this->add('42;;Bloc de fer');

    $this->add('43;0;Double dalles');
    $this->add('43;1;??');
    $this->add('43;3;??');
    $this->add('43;4;??');
    $this->add('43;5;Pierres taillées');
    $this->add('43;6;??');

    $this->add('44;;Dalles');
    $this->add('45;;Bloc de brique d\'argile');
    $this->add('46;;TNT');
    $this->add('47;;Bibliothèque');
    $this->add('48;;Pierre moussue');
    $this->add('49;;Obsidienne');
    $this->add('50;;Torche');
    $this->add('51;;Feu');
    $this->add('52;;Générateur de monstre');
    $this->add('53;;Escaliers en bois');
    $this->add('54;;Coffre');
    $this->add('55;;Câble de redstone');
    $this->add('56;;Minerai de diamant');
    $this->add('57;;Bloc de diamant');
    $this->add('58;;Établi');
    $this->add('59;;Blé');
    $this->add('60;;Terre labourée');
    $this->add('61;;Four');
    $this->add('62;;Four en utilisation');
    $this->add('63;;Panneau');
    $this->add('64;;Porte en bois');
    $this->add('65;;Echelle');
    $this->add('66;;Rails');
    $this->add('67;;Escaliers en pierre');
    $this->add('68;;Panneau mural');
    $this->add('69;;Levier');
    $this->add('70;;Plaque de détection en pierre');
    $this->add('71;;Porte en fer');
    $this->add('72;;Plaque de détection en bois');
    $this->add('73;;Minerai de redstone');
    $this->add('74;;Minerai de redstone lumineux');
    $this->add('75;;Torche de redstone (éteinte)');
    $this->add('76;;Torche de redstone (allumée)');
    $this->add('77;;Bouton en pierre');
    $this->add('78;;Neige');
    $this->add('79;;Glace');
    $this->add('80;;Bloc de neige');
    $this->add('81;;Cactus');
    $this->add('82;;Bloc d\'argile');
    $this->add('83;;Canne à sucre');
    $this->add('84;;Jukebox');
    $this->add('85;;Barrière');
    $this->add('86;;Citrouille');
    $this->add('87;;Netherrack');
    $this->add('88;;Soulsand');
    $this->add('89;;Bloc de Glowstone');
    $this->add('90;;Portial');
    $this->add('91;;Citrouille-lanterne');
    $this->add('92;;Gâteau');
    $this->add('93;;Répéteur de redstone (éteint)');
    $this->add('94;;Répéteur de redstone (allumé)');
    $this->add('95;;Coffre verrouillé');
    $this->add('96;;Trappe');
    $this->add('97;;Poisson d\'argent caché');
    $this->add('98;;Brique de pierre');
    $this->add('99;;Champignon géant brun');
    $this->add('101;;Champignon géant rouge');
    $this->add('101;;Barreaux de fer');
    $this->add('102;;Vitre');
    $this->add('103;;Bloc de pastèque');
    $this->add('104;;Pied de citrouille');
    $this->add('105;;Pied de melon');
    $this->add('106;;Lierre');
    $this->add('107;;Portillon');
    $this->add('108;;Escaliers en brique d\'argile');
    $this->add('109;;Escaliers en brique de pierre');
    $this->add('110;;Mycélium');
    $this->add('111;;Nénuphar');
    $this->add('112;;Brique du Nether');
    $this->add('113;;Barrière en brique du Nether');
    $this->add('114;;Escaliers en brique du Nether');
    $this->add('115;;Verrue du Nether');
    $this->add('116;;Table d\'enchantement');

    $this->add('256;;Pelle en fer');
    $this->add('257;;Pioche en fer ');
    $this->add('258;;Hache en fer ');
    $this->add('267;;Épée en fer ');
    $this->add('276;;Épée en diamant');
    $this->add('277;;Pelle en diamant');
    $this->add('278;;Pioche en diamant ');
    $this->add('279;;Hache en diamant ');
    $this->add('292;;Houe en fer ');
    $this->add('293;;Houe en diamant ');
    $this->add('306;;Casque en fer ');
    $this->add('307;;Cuirasse en fer ');
    $this->add('308;;Jambières en fer ');
    $this->add('309;;Bottes en fer ');
    $this->add('310;;Casque en diamant ');
    $this->add('311;;Cuirasse en diamant ');
    $this->add('312;;Jambières en diamant ');
    $this->add('313;;Bottes en diamant ');

  }

  /**
   * Ajoute une DataValue à la liste
   * Format de $values : id;subid;name
   */
  private function add($values) {
    $values = explode(';', $values);

    $id = $values[0];
    $subid = (empty($values[1])) ? 0 : $values[1];
    $name = $values[2];

    $this->data_values[$id][$subid] = $name;
  }

  /**
   * Retourne UNE DataValue
   */
  public function get($id, $subid = 0) {
    if (isset($this->data_values[$id][$subid])) {
      return $this->data_values[$id][$subid];
    } else {
      return null;
    }
  }

  /**
   * Retourne toutes les DataValues
   */
  public function getAll() {
    return $this->data_values;
  }

  /**
   * Retourne DataValues dont le nom correspond à $name (totalement ou en partie)
   */
  public function searchByName($search) {
    $return = array();

    foreach ($this->data_values as $id => $infos) {
      foreach ($infos as $subid => $name) {
        if (strpos($name, $search) !== false) {
          $return[$id][$subid] = $name;
        }
      }
    }

    return $return;
  }

  /**
   * Lien vers l'image de l'item
   */
  public function getImage($id, $subid = 0) {
    if (isset($this->data_values[$id][$subid])) {
      return 'img/items/'.$id.'-'.$subid.'.png';
    } else {
      return 'img/items/noimage.png';
    }
  }

  /**
   * Retourne le nom d'un bloc / objet
   */
  public function getLabel($id, $subid = 0) {
    if (isset($this->data_values[$id][$subid])) {
      return $this->data_values[$id][$subid];
    } else {
      return '';
    }
  }
}
?>