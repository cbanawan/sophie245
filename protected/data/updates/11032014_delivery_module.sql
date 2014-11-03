CREATE  TABLE IF NOT EXISTS `sophie_paris_bc`.`Deliveries` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `dateCreated` DATETIME NULL ,
  `dateLastModified` DATETIME NULL ,
  `dateDelivered` DATETIME NULL ,
  `purchaseOrderId` INT NOT NULL ,
  `receivedBy` INT NOT NULL ,
  `deliveryConfirmed` TINYINT NOT NULL DEFAULT 0 ,
  `deliveryNo` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Deliveries_PurchaseOrders1_idx` (`purchaseOrderId` ASC) ,
  INDEX `fk_Deliveries_Users1_idx` (`receivedBy` ASC) ,
  CONSTRAINT `fk_Deliveries_PurchaseOrders1`
    FOREIGN KEY (`purchaseOrderId` )
    REFERENCES `sophie_paris_bc`.`PurchaseOrders` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Deliveries_Users1`
    FOREIGN KEY (`receivedBy` )
    REFERENCES `sophie_paris_bc`.`Users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB

CREATE  TABLE IF NOT EXISTS `sophie_paris_bc`.`DeliveryProducts` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `deliveryId` INT NOT NULL ,
  `productId` INT NOT NULL ,
  `ordered` INT NULL DEFAULT 0 ,
  `delivered` INT NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_Deliveries_has_Products_Products1_idx` (`productId` ASC) ,
  INDEX `fk_Deliveries_has_Products_Deliveries1_idx` (`deliveryId` ASC) ,
  CONSTRAINT `fk_Deliveries_has_Products_Deliveries1`
    FOREIGN KEY (`deliveryId` )
    REFERENCES `sophie_paris_bc`.`Deliveries` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Deliveries_has_Products_Products1`
    FOREIGN KEY (`productId` )
    REFERENCES `sophie_paris_bc`.`Products` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB