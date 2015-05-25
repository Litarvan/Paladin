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

require_once 'Twig/Autoloader.php';
require_once 'RouteLoader.php';
require_once 'PageLoader.php';
require_once 'ThemeLoader.php';

/**
 * The Paladin Main Class
 *
 * @author TheShark34
 * @package Paladin
 * @version 1.0.0-BETA
 */
class Paladin {

  private static $rootFolder;
  private static $registered = false;
  private static $twig;
  private static $routeLoader;
  private static $pageLoader;
  private static $themeLoader;

  public static function getRootFolder() {
    if(!isset(self::$rootFolder))
      self::$rootFolder = "/" . str_replace($_SERVER['DOCUMENT_ROOT'], "", dirname($_SERVER['SCRIPT_FILENAME'])) . "/";
    
    return self::$rootFolder;
  }

  public static function loadTwig() {
    if(!self::$registered) {
      \Twig_Autoloader::register();
      self::$registered = true;
      $loader = new \Twig_Loader_Filesystem("./");
      self::$twig = new \Twig_Environment($loader, array(
          'cache' => 'Paladin/Cache/Twig_Compilation_Cache/',
          'auto_reload' => 'true'
      ));
    }
  }

  public static function getTwig() {
    return self::$twig;
  }

  public static function printError($message, $header, $fatal) {
    header($header);
    echo "<h1>Paladin" . ($fatal ? " Fatal" : "") . " Error</h1><p>" . $message . "</p>";
    if($fatal)
      die();
  }

  public static function loadPage($namespace, $page, $args) {
    if(!isset(self::$pageLoader)) {
      self::$pageLoader = new PageLoader("Pages");
      Paladin::loadTwig();
      self::$pageLoader->addTwigFunction();
    }

    self::$pageLoader->displayPage($namespace, $page, $args);
  }

  public static function getRouteLoader() {
    if(!isset(self::$routeLoader))
      self::$routeLoader = new RouteLoader("Routes");

    return self::$routeLoader;
  }

  public static function getThemeLoader() {
    if(!isset(self::$themeLoader))
      self::$themeLoader = new ThemeLoader("Themes");

    return self::$themeLoader;
  }

}
