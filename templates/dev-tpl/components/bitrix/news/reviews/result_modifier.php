<?php
  use \Placestart\Utils;

  $arResult["YANDEX"] = [
    "LINK" => Utils::getSiteOption("yandex_reviews_link"),
    "COUNT" => Utils::getSiteOption("yandex_reviews_count")
  ];

  $arResult["2GIS"] = [
    "LINK" => Utils::getSiteOption("2gis_reviews_link"),
    "COUNT" => Utils::getSiteOption("2gis_reviews_count")
  ];

  $arResult["GOOGLE"] = [
    "LINK" => Utils::getSiteOption("google_reviews_link"),
    "COUNT" => Utils::getSiteOption("google_reviews_count")
  ];

  // $arResult[] = [
  //   "YANDEX" => [
  //     "LINK" => Utils::getSiteOption("yandex_reviews_link"),
  //     "COUNT" => Utils::getSiteOption("yandex_reviews_count")
  //   ],
  //   "2GIS" => [
  //     "LINK" => Utils::getSiteOption("2gis_reviews_link"),
  //     "COUNT" => Utils::getSiteOption("2gis_reviews_count")
  //   ],
  //   "GOOGLE" => [
  //     "LINK" => Utils::getSiteOption("google_reviews_link"),
  //     "COUNT" => Utils::getSiteOption("google_reviews_count")
  //   ],
  // ];
?>