<?php

/**
 * @author Serkin Alexander <serkin.alexander@gmail.com>
 * @license https://github.com/serkin/ymlparser/LICENSE MIT
 */

namespace YMLParser\Driver;

class SimpleXML implements DriverInterface {

    /**
     * @var \SimpleXMLElement
     */
    private $xml;


    private $arr_elems = ['param', 'picture', 'categoryid', 'orderingtime'];


    public function getShopInfo() {

        $returnArr = ['name' => (string) $this->xml->shop->name, 'company' => (string) $this->xml->shop->company, 'url' => (string)$this->xml->shop->url];

        return $returnArr;
    }

    /**
     * Gets categories.
     *
     * @return arry Array of \YMLParser\Node\Category instances or empty array
     */
    public function getCategories() {
        $returnArr = [];

        foreach ($this->xml->shop->categories->category as $category):

            $arr = array_merge(
                    ['value' => (string) $category], $this->getElementAttributes($category));

            $returnArr[] = new \YMLParser\Node\Category($arr);

        endforeach;

        return $returnArr;
    }

    /**
     * Gets offers.
     *
     * @param \Closure $filter Anonymous function
     *
     * @return \Iterator Array of of \YMLParser\Node\Offer instances or empty array
     */
    public function getOffers(\Closure $filter = null) {
        foreach ($this->xml->shop->offers->offer as $offer) {

            $arr = $this->getElementAttributes($offer);
            $arr['params'] = $this->parseParamsFromElement($offer);
            $arr['picture'] = $this->parsePicturesFromElement($offer);
            $arr['categoryid'] = $this->parseCategoriesFromElement($offer);
            $arr['orderingtime'] = $this->parseOrderingTimeFromElement($offer);


            foreach ($offer->children() as $element) {
                $name = mb_strtolower($element->getName());

                if (!in_array($name, $this->arr_elems)) {
                    $arr[$name] = (string) $element;
                }
            }

            $returnValue = new \YMLParser\Node\Offer($arr);

            if (!is_null($filter)) {
                if ($filter($returnValue)) {
                    yield $returnValue;
                }
            } else {
                yield $returnValue;
            }
        }


    }

    /**
     * Gets currencies.
     *
     * @return array
     */
    public function getCurrencies() {

        $returnArr = [];

        foreach ($this->xml->shop->currencies->currency as $category):

            $arr = array_merge(
                    ['value' => (string) $category], $this->getElementAttributes($category));

            $returnArr[] = new \YMLParser\Node\Currency($arr);

        endforeach;

        return $returnArr;
    }

    /**
     * Gets amount of offers.
     *
     * @return int
     */
    public function countOffers(\Closure $filter = null) {
        $returnValue = 0;

        foreach ($this->getOffers($filter) as $el):
            $returnValue++;
        endforeach;

        return $returnValue;
    }

    /**
     * Opens filename.
     *
     * @param string $filename
     *
     * @return bool
     */
    public function open($filename) {

        $this->xml = simplexml_load_file($filename);

        return (bool) $this->xml;
    }

    /**
     * Gets element params.
     *
     * @param \SimpleXMLElement $offer
     *
     * @return array
     */
    private function parseParamsFromElement(\SimpleXMLElement $offer) {
        $returnArr = [];

        foreach ($offer->children() as $element) {

            if (mb_strtolower($element->getName()) == 'param') {
                $returnArr[] = array_merge(
                        ['value' => (string) $element], $this->getElementAttributes($element)
                );
            }
        }

        return $returnArr;
    }

    /**
     * Gets element pictures.
     *
     * @param \SimpleXMLElement $offer
     *
     * @return array
     */
    private function parsePicturesFromElement(\SimpleXMLElement $offer) {
        $returnArr = [];

        foreach ($offer->children() as $element) {

            if (mb_strtolower($element->getName()) == 'picture') {
                $returnArr[] = (string) $element;
            }
        }

        return $returnArr;
    }

    private function parseCategoriesFromElement(\SimpleXMLElement $offer) {
        $returnArr = [];

        foreach ($offer->children() as $element) {

            if (mb_strtolower($element->getName()) == 'categoryid') {
                $returnArr[] = (string) $element;
            }
        }



        return $returnArr;
    }

    private function parseOrderingTimeFromElement(\SimpleXMLElement $offer) {
        $returnArr = [];

        foreach ($offer->children() as $element) {

            if (mb_strtolower($element->getName()) == 'orderingtime') {
                $returnArr[] = (array) $element;
            }
        }



        return $returnArr;
    }

    /**
     * Gets lement attributes.
     *
     * @param \SimpleXMLElement $element
     *
     * @return array
     */
    private function getElementAttributes(\SimpleXMLElement $element) {
        $returnArr = [];

        foreach ($element->attributes() as $attrName => $attrValue):
            $returnArr[strtolower($attrName)] = (string) $attrValue;
        endforeach;

        return $returnArr;
    }

}
