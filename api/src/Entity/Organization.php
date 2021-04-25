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
 * An organization such as a school, NGO, corporation, club, etc.
 *
 * @see http://schema.org/Organization
 *
 * @author Pierre Pailley
 *
 * @ORM\Entity
 *
 */
#[ApiResource(iri:"http://schema.org/Organization")]
class Organization
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     * @Assert\Uuid
     */
    private ?string $id = null;

    /**
     * The official name of the organization, e.g. the registered company name.
     *
     * @see http://schema.org/legalName
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/legalName")
     * @Assert\Type(type="string")
     */
    private ?string $legalName = null;

    /**
     * An associated logo.
     *
     * @see http://schema.org/logo
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/logo")
     * @Assert\Url
     */
    private ?string $logo = null;

    /**
     * An organization identifier that uniquely identifies a legal entity as defined in ISO 17442.
     *
     * @see http://schema.org/leiCode
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/leiCode")
     * @Assert\Type(type="string")
     */
    private ?string $leiCode = null;

    /**
     * A pointer to products or services offered by the organization or person.
     *
     * @see http://schema.org/makesOffer
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Offer", mappedBy="offeredBy")
     * @ApiProperty(iri="http://schema.org/makesOffer")
     */
    private ?Collection $makesOffer = null;

    /**
     * A member of an Organization or a ProgramMembership. Organizations can be members of organizations; ProgramMembership is typically for individuals.
     *
     * @see http://schema.org/member
     *
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="memberOf")
     * @ApiProperty(iri="http://schema.org/member")
     */
    private ?User $member = null;

    public function __construct()
    {
        $this->makesOffer = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setLegalName(?string $legalName): void
    {
        $this->legalName = $legalName;
    }

    public function getLegalName(): ?string
    {
        return $this->legalName;
    }

    public function setLogo(?string $logo): void
    {
        $this->logo = $logo;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLeiCode(?string $leiCode): void
    {
        $this->leiCode = $leiCode;
    }

    public function getLeiCode(): ?string
    {
        return $this->leiCode;
    }

    public function addMakesOffer(Offer $makesOffer): void
    {
        $this->makesOffer[] = $makesOffer;
    }

    public function removeMakesOffer(Offer $makesOffer): void
    {
        $this->makesOffer->removeElement($makesOffer);
    }

    public function getMakesOffer(): Collection
    {
        return $this->makesOffer;
    }

    public function setMember(?User $member): void
    {
        $this->member = $member;
    }

    public function getMember(): ?User
    {
        return $this->member;
    }
}
