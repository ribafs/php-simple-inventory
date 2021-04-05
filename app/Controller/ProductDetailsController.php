<?php


namespace App\Controller;


use App\Model\DigitalProduct;
use App\Model\MonitoringDAO;
use App\Model\PhysicalProduct;
use App\Model\ProductDAO;
use App\Model\WarrantyDAO;

class ProductDetailsController
{
    private static ProductDetailsController $_instance;
    private array $productDetails;
    private ?array $warrantiesList;
    private ?array $monitoringDetails;
    private string $activePage;

    private function __construct(int $productID)
    {
        $product = ProductDAO::getProductByID($productID);
        if ($product instanceof PhysicalProduct) {
            $warrantiesCollection = WarrantyDAO::getWarrantyByProductID($productID);
            foreach ($warrantiesCollection as $key => $val) {
                $this->warrantiesList[] = array('WarrantyName' => $val->getWarrantyName(),
                    'ExpDate' => $val->getExpirationDate()->format("Y-m-d"));
            }

            $monitoring = MonitoringDAO::getMonitoringByProductID($productID);
            if (!is_null($monitoring)) {
                $this->monitoringDetails = array('IP' => $monitoring->getIP(),
                    'LastPing' => $monitoring->getLastPing()->format("Y-m-d h:i A"),
                    'Status' => $monitoring->isUp());
            }

            $this->productDetails = array('ProductName' => $product->getProductName(),
                'Manufacturer' => $product->getManufacturer(),
                'ModelNo' => $product->getModelNo(),
                'SerialNo' => $product->getSerialNo(),
                'PurchaseDate' => $product->getPurchaseDate()->format("Y-m-d"),
                'BillPath' => $product->getBillPath(),
                'Type' => "Physical",
                'Hostname' => $product->getHostname(),
                'Warranties' => isset($this->warrantiesList) ? $this->warrantiesList : null,
                'Monitoring' => isset($this->monitoringDetails) ? $this->monitoringDetails : null);
        } elseif ($product instanceof DigitalProduct) {
            $this->productDetails = array('ProductName' => $product->getProductName(),
                'Manufacturer' => $product->getManufacturer(),
                'ModelNo' => $product->getModelNo(),
                'SerialNo' => $product->getSerialNo(),
                'PurchaseDate' => $product->getPurchaseDate()->format("Y-m-d"),
                'BillPath' => $product->getBillPath(),
                'Type' => "Digital",
                'ExpDate' => $product->getExpirationDate()->format("Y-m-d"));
        }

    }

    public static function getInstance(int $productID): ProductDetailsController
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new self($productID);
        }
        return self::$_instance;
    }

    public function render()
    {
        $this->activePage = "productList";
        include_once "app/View/header.php";
        include_once "app/View/productDetailsView.php";
        include_once "app/View/footer.php";
    }
}