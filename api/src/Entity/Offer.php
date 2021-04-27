<?php

/*
 * This file is part of the Ecommerce package.
 *
 * (c) Pierre Pailley
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An offer to transfer some rights to an item or to provide a service — for example, an offer to sell tickets to an event, to rent the DVD of a movie, to stream a TV show over the internet, to repair a motorcycle, or to loan a book.\\n\\nNote: As the \[\[businessFunction\]\] property, which identifies the form of offer (e.g. sell, lease, repair, dispose), defaults to http://purl.org/goodrelations/v1#Sell; an Offer without a defined businessFunction value can be assumed to be an offer to sell.\\n\\nFor \[GTIN\](http://www.gs1.org/barcodes/technical/idkeys/gtin)-related fields, see \[Check Digit calculator\](http://www.gs1.org/barcodes/support/check\_digit\_calculator) and \[validation guide\](http://www.gs1us.org/resources/standards/gtin-validation-guide) from \[GS1\](http://www.gs1.org/).
 *
 * @see http://schema.org/Offer
 *
 * @author Pierre Pailley
 *
 * @ORM\Entity
 * @ApiResource(iri="http://schema.org/Offer")
 */
class Offer
{
    use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     * @Assert\Uuid
     */
    private ?string $id = null;

    /**
     * An item being offered (or demanded). The transactional nature of the offer or demand is documented using \[\[businessFunction\]\], e.g. sell, lease etc. While several common expected types are listed explicitly in this definition, others can be used. Using a second type, such as Product or a subtype of Product, can clarify the nature of the offer.
     *
     * @see http://schema.org/itemOffered
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Service", inversedBy="offers")
     * @ORM\JoinColumn(nullable=false)
     * @ApiProperty(iri="http://schema.org/itemOffered")
     */
    private ?Service $itemOffered = null;

    /**
     * A pointer to the organization or person making the offer.
     *
     * @see http://schema.org/offeredBy
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Organization", inversedBy="makesOffer")
     * @ApiProperty(iri="http://schema.org/offeredBy")
     */
    private ?Organization $offeredBy = null;

    /**
     * The offer price of a product, or of a price component when attached to PriceSpecification and its subtypes.\\n\\nUsage guidelines:\\n\\n\* Use the \[\[priceCurrency\]\] property (with standard formats: \[ISO 4217 currency format\](http://en.wikipedia.org/wiki/ISO\_4217) e.g. "USD"; \[Ticker symbol\](https://en.wikipedia.org/wiki/List\_of\_cryptocurrencies) for cryptocurrencies e.g. "BTC"; well known names for \[Local Exchange Tradings Systems\](https://en.wikipedia.org/wiki/Local\_exchange\_trading\_system) (LETS) and other currency types e.g. "Ithaca HOUR") instead of including \[ambiguous symbols\](http://en.wikipedia.org/wiki/Dollar\_sign#Currencies\_that\_use\_the\_dollar\_or\_peso\_sign) such as '$' in the value.\\n\* Use '.' (Unicode 'FULL STOP' (U+002E)) rather than ',' to indicate a decimal point. Avoid using these symbols as a readability separator.\\n\* Note that both \[RDFa\](http://www.w3.org/TR/xhtml-rdfa-primer/#using-the-content-attribute) and Microdata syntax allow the use of a "content=" attribute for publishing simple machine-readable values alongside more human-friendly formatting.\\n\* Use values from 0123456789 (Unicode 'DIGIT ZERO' (U+0030) to 'DIGIT NINE' (U+0039)) rather than superficially similiar Unicode symbols.
     *
     * @see http://schema.org/price
     *
     * @ORM\Column(type="integer", options={"comment" = "price of offers"})
     * @ApiProperty(iri="http://schema.org/price")
     * @Assert\Type(type="int")
     */
    private ?string $price = null;

    /**
     * The currency of the price, or a price component when attached to \[\[PriceSpecification\]\] and its subtypes.\\n\\nUse standard formats: \[ISO 4217 currency format\](http://en.wikipedia.org/wiki/ISO\_4217) e.g. "USD"; \[Ticker symbol\](https://en.wikipedia.org/wiki/List\_of\_cryptocurrencies) for cryptocurrencies e.g. "BTC"; well known names for \[Local Exchange Tradings Systems\](https://en.wikipedia.org/wiki/Local\_exchange\_trading\_system) (LETS) and other currency types e.g. "Ithaca HOUR".
     *
     * @see http://schema.org/priceCurrency
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/priceCurrency")
     * @Assert\Type(type="string")
     */
    private ?string $priceCurrency = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setItemOffered(?Service $itemOffered): void
    {
        $this->itemOffered = $itemOffered;
    }

    public function getItemOffered(): ?Service
    {
        return $this->itemOffered;
    }

    public function setOfferedBy(?Organization $offeredBy): void
    {
        $this->offeredBy = $offeredBy;
    }

    public function getOfferedBy(): ?Organization
    {
        return $this->offeredBy;
    }

    public function setPrice(?string $price): void
    {
        $this->price = $price;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPriceCurrency(?string $priceCurrency): void
    {
        $this->priceCurrency = $priceCurrency;
    }

    public function getPriceCurrency(): ?string
    {
        return $this->priceCurrency;
    }
}
