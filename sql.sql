ALTER TABLE  `product` ADD  `moreInfo` LONGTEXT NOT NULL

ALTER TABLE  `productrating` ADD  `reviewId` INT NOT NULL

/*Delete table product rating*/

ALTER TABLE  `productreview` ADD  `rating` INT NOT NULL AFTER  `review`