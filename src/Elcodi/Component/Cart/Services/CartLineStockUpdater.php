<?php

/*
 * This file is part of the Elcodi package.
 *
 * Copyright (c) 2014-2015 Elcodi Networks S.L.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Feel free to edit as you please, and have fun.
 *
 * @author Marc Morera <yuhu@mmoreram.com>
 * @author Aldo Chiecchia <zimage@tiscali.it>
 * @author Elcodi Team <tech@elcodi.com>
 */

namespace Elcodi\Component\Cart\Services;

use Doctrine\Common\Persistence\ObjectManager;

use Elcodi\Component\Cart\Entity\Interfaces\CartLineInterface;
use Elcodi\Component\Product\ElcodiProductStock;
use Elcodi\Component\Product\Entity\Interfaces\ProductInterface;
use Elcodi\Component\Product\Entity\Interfaces\PurchasableInterface;
use Elcodi\Component\Product\Entity\Interfaces\VariantInterface;

/**
 * Class CartLineStockUpdater.
 *
 * Api Methods:
 *
 * * updatePurchasableStockByCartLine(CartLineInterface)
 *
 * @api
 */
class CartLineStockUpdater
{
    /**
     * @var ObjectManager
     *
     * ObjectManager for Product
     */
    private $productObjectManager;

    /**
     * @var ObjectManager
     *
     * ObjectManager for Variant
     */
    private $variantObjectManager;

    /**
     * Built method.
     *
     * @param ObjectManager $productObjectManager Product Object Manager
     * @param ObjectManager $variantObjectManager Variant Object Manager
     */
    public function __construct(
        ObjectManager $productObjectManager,
        ObjectManager $variantObjectManager
    ) {
        $this->productObjectManager = $productObjectManager;
        $this->variantObjectManager = $variantObjectManager;
    }

    /**
     * Performs all processes to be performed after the order creation.
     *
     * Flushes all loaded order and related entities.
     *
     * @param CartLineInterface $cartLine Cart line
     */
    public function updatePurchasableStockByCartLine(CartLineInterface $cartLine)
    {
        $purchasable = $cartLine->getPurchasable();
        $stock = $purchasable->getStock();

        if ($stock === ElcodiProductStock::INFINITE_STOCK) {
            return;
        }

        $quantityPurchased = $cartLine->getQuantity();

        $newStock = $stock - $quantityPurchased;
        $newStock = max($newStock, 0);
        $purchasable->setStock($newStock);

        $this->flushPurchasable($purchasable);
    }

    /**
     * Flush the purchasable object, depending on the type.
     *
     * @param PurchasableInterface $purchasable Purchasable object to flush
     *
     * @return $this Self object
     */
    private function flushPurchasable(PurchasableInterface $purchasable)
    {
        if ($purchasable instanceof ProductInterface) {
            $this
                ->productObjectManager
                ->flush($purchasable);
        } elseif ($purchasable instanceof VariantInterface) {
            $this
                ->variantObjectManager
                ->flush($purchasable);
        }

        return $this;
    }
}
