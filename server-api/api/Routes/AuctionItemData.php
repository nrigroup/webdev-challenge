<?php

require_once __DIR__.'/../Database/AuctionItemDao.php';

class AuctionItemData
{
    private $auctionItemDao;
    public function __construct() {
        include '../Database/AuctionItemDao.php';
        $this->auctionItemDao = new AuctionItemDao();
    }

    public function Get() {
        return $this->auctionItemDao->GetItems();
    }
    public function Upload() {
        $date           = urldecode($_GET["date"]);
        $category       = urldecode($_GET["category"]);
        $lot_title      = urldecode($_GET["lot_title"]);
        $lot_location   = urldecode($_GET["lot_location"]);
        $lot_condition  = urldecode($_GET["lot_condition"]);
        $pre_tax_amount = urldecode($_GET["pre_tax_amount"]);
        $tax_name       = urldecode($_GET["tax_name"]);
        $tax_amount     = urldecode($_GET["tax_amount"]);

        $this->auctionItemDao->AddData( $date, $category, $lot_title, $lot_location, $lot_condition, $pre_tax_amount, $tax_name, $tax_amount );

        return 1;
    }
}