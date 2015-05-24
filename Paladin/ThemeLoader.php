<?php

/*
 * Copyright 2015 TheShark34
 *
 * This file is part of Paladin.
 *
 * Paladin is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Paladin is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with Paladin.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Paladin;

require_once 'Paladin.php';

/**
 * The Theme loader
 *
 * @author TheShark34
 * @package Paladin
 * @version 1.0.0-BETA
 */
class ThemeLoader {

  /**
   * The folder containing the pages
   */
  private $folder;

  /**
   * An array of all themes
   */
  private $themes;

  /**
   * The current theme
   */
  private $currentTheme;

  /**
   * Inits the PageLoader with a folder, containing the pages
   */
  public function __construct($folder) {
    $this->folder = $folder;
  }

  /**
   * Loads all themes in the folder
   */
  public function loadThemes() {
    $folderList = scandir($this->folder);
    for ($i = 0; $i < sizeof($folderList); $i++)
      if(is_dir($folderList[$i]) && $folderList[$i] != "." && $folderList[$i] != "..")
        $this->themes[$i] = $folderList[$i];
  }

  /**
   * Returns the list of all themes
   */
  public function getThemes() {
    return $this->themes;
  }

  /**
   * Sets a new theme
   */
  public function setCurrentTheme($theme) {
    $this->currentTheme = $them;
  }

  /**
   * Returns the current theme
   *
   * @return The current theme
   */
  public function getCurrentTheme() {
    return $this->currentTheme;
  }

}
