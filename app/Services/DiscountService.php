<?php

namespace App\Services;

class DiscountService
{
    /**
     * Calculate the discounted price.
     *
     * @param float $originalPrice The original price of the product.
     * @param float $discountPercentage The discount percentage (0-100).
     * @return float The price after applying the discount.
     * @throws \InvalidArgumentException If inputs are invalid.
     */
    public function getDiscountedPrice(float $originalPrice, float $discountPercentage): float
    {
        if ($originalPrice < 0 || $discountPercentage < 0 || $discountPercentage > 100) {
            throw new \InvalidArgumentException('Invalid price or discount percentage.');
        }

        $discountAmount = ($originalPrice * $discountPercentage) / 100;
        return round($originalPrice - $discountAmount, 2);
    }
}