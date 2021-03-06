<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\PricingBundle\Twig;

use Sylius\Bundle\PricingBundle\Templating\Helper\PricingHelper;
use Sylius\Component\Pricing\Model\PriceableInterface;

/**
 * @author Paweł Jędrzejewski <pawel@sylius.org>
 */
final class PricingExtension extends \Twig_Extension
{
    /**
     * @var PricingHelper
     */
    protected $helper;

    /**
     * @param PricingHelper $helper
     */
    public function __construct(PricingHelper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('sylius_calculate_price', [$this, 'calculatePrice'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * @param PriceableInterface $priceable
     * @param array              $context
     *
     * @return int
     */
    public function calculatePrice(PriceableInterface $priceable, array $context = [])
    {
        return $this->helper->calculatePrice($priceable, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'sylius_pricing';
    }
}
