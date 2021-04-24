<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><a href="?action=productList" class="link-secondary text-decoration-none">Products</a> / <a
                href="?action=productDetails&productID=<?= $this->productDetails['ProductID'] ?>"
                class="link-secondary text-decoration-none">Product details</a> / Edit</h1>
</div>
<div class="container">
    <form action="./?action=productEditSave&productID=<?= $this->productDetails['ProductID'] ?>" method="POST"
          class="row g-3">
        <div class="col-md-6">
            <label for="inputProdName" class="form-label">Name</label>
            <input type="text" class="form-control" name="inputProdName"
                   value="<?= $this->productDetails['ProductName'] ?>">
        </div>
        <div class="col-md-6">
            <?php if ($this->productDetails['Type'] == "Physical") { ?>
                <label for="inputProdHostname" class="form-label">Hostname</label>
                <input type="text" class="form-control" name="inputProdHostname"
                       value="<?= $this->productDetails['Hostname'] ?>">
            <?php } elseif ($this->productDetails['Type'] == "Digital") { ?>
                <label for="inputProdExpDate" class="form-label">Expiration date</label>
                <input type="text" class="form-control" name="inputProdExpDate"
                       value="<?= $this->productDetails['ExpDate'] ?>">
            <?php } ?>
        </div>
        <div class="col-md-6">
            <label for="inputProdManufacturer" class="form-label">Manufacturer</label>
            <input type="text" class="form-control" name="inputProdManufacturer"
                   value="<?= $this->productDetails['Manufacturer'] ?>">
        </div>
        <div class="col-md-6">
            <label for="inputProdModelNo" class="form-label">Model N°</label>
            <input type="text" class="form-control" name="inputProdModelNo"
                   value="<?= $this->productDetails['ModelNo'] ?>">
        </div>
        <div class="col-md-6">
            <label for="inputProdSerialNo" class="form-label">Serial N°</label>
            <input type="text" class="form-control" name="inputProdSerialNo"
                   value="<?= $this->productDetails['SerialNo'] ?>">
        </div>
        <div class="col-md-6">
            <label for="inputProdPurchaseDate" class="form-label">Purchase Date</label>
            <input type="text" class="form-control" name="inputProdPurchaseDate"
                   value="<?= $this->productDetails['PurchaseDate'] ?>">
        </div>
        <div class="col-md-6">
            <label for="inputProdBillPath" class="form-label">Bill path</label>
            <input type="text" class="form-control" name="inputProdBillPath"
                   value="<?= $this->productDetails['BillPath'] ?>">
        </div>
        <div class="col-md-6">
            <label for="inputProdType" class="form-label">Type</label>
            <input type="text" class="form-control" name="inputProdType" disabled readonly
                   value="<?= $this->productDetails['Type'] ?>">
        </div>
        <?php if ($this->productDetails['Type'] == "Physical") { ?>
            <div class="col-md-3">
                <label for="inputProdSite" class="form-label">Site</label>
                <select class="form-select" name="inputProdSite" required>
                    <option selected
                            value="<?= $this->siteDetails['SiteID'] ?>"><?= $this->siteDetails['SiteName'] ?></option>
                    <?php foreach ($siteList as $key => $val) { ?>
                        <option value="<?= $key ?>"><?= $val ?></option>
                    <?php } ?>
                </select>
            </div>
        <?php } ?>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>