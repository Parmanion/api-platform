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
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A service provided by an organization, e.g. delivery service, print services, etc.
 *
 * @see http://schema.org/Service
 *
 * @author Pierre Pailley
 *
 * @ORM\Entity
 * @ApiResource(iri="http://schema.org/Service")
 */
class Service
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     * @Assert\Uuid
     */
    private ?string $id = null;

    /**
     * An offer to provide this item—for example, an offer to sell a product, rent the DVD of a movie, perform a service, or give away tickets to an event. Use \[\[businessFunction\]\] to indicate the kind of transaction offered, i.e. sell, lease, etc. This property can also be used to describe a \[\[Demand\]\]. While this property is listed as expected on a number of common types, it can be used in others. In that case, using a second type, such as Product or a subtype of Product, can clarify the nature of the offer.
     *
     * @see http://schema.org/offers
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Offer", mappedBy="itemOffered")
     * @ApiProperty(iri="http://schema.org/offers")
     */
    private ?Collection $offers = null;

    /**
     * The service provider, service operator, or service performer; the goods producer. Another party (a seller) may offer those services or goods on behalf of the provider. A provider may also serve as the seller.
     *
     * @see http://schema.org/provider
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Organization")
     * @ApiProperty(iri="http://schema.org/provider")
     */
    private ?Organization $provider = null;

    public function __construct()
    {
        $this->offers = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function addOffer(Offer $offer): void
    {
        $this->offers[] = $offer;
    }

    public function removeOffer(Offer $offer): void
    {
        $this->offers->removeElement($offer);
    }

    public function getOffers(): Collection
    {
        return $this->offers;
    }

    public function setProvider(?Organization $provider): void
    {
        $this->provider = $provider;
    }

    public function getProvider(): ?Organization
    {
        return $this->provider;
    }
}
