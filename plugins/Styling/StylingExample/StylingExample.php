<?php

class StylingExample implements IStylingFactory
{
    /**
     * @var StylingFactory
     */
    private $factoryToDecorate;

    public function __construct(StylingFactory $factoryToDecorate)
    {
        $this->factoryToDecorate = $factoryToDecorate;
    }

    public function AdditionalCSS(UserSession $userSession)
    {
        return realpath(__DIR__ . DIRECTORY_SEPARATOR . 'StylingExample.css');
    }

    public function GetReservationAdditonalCSSClasses(IReservedItemView $item)
    {
        $additionalCSSClasses = $this->factoryToDecorate->GetReservationAdditonalCSSClasses($item) ?? [];

        if (str_starts_with($item->GetTitle(), 'Example')) {
            $additionalCSSClasses[] = 'custom-example-class';
        }

        return $additionalCSSClasses;
    }
}
