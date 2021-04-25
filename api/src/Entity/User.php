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
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A person (alive, dead, undead, or fictional).
 *
 * @see http://schema.org/Person
 *
 * @author Pierre Pailley
 *
 * @ORM\Entity
 * @ApiResource(shortName="Person", iri="http://schema.org/Person")
 * @UniqueEntity("email")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     * @Assert\Uuid
     */
    private ?string $id = null;

    /**
     * Email address.
     *
     * @see http://schema.org/email
     *
     * @ORM\Column(type="text", nullable=true, unique=true)
     * @ApiProperty(iri="http://schema.org/email")
     * @Assert\Email
     */
    private ?string $email = null;

    /**
     * Gender of something, typically a \[\[Person\]\], but possibly also fictional characters, animals, etc. While http://schema.org/Male and http://schema.org/Female may be used, text strings are also acceptable for people who do not identify as a binary gender. The \[\[gender\]\] property can also be used in an extended sense to cover e.g. the gender of sports teams. As with the gender of individuals, we do not try to enumerate all possibilities. A mixed-gender \[\[SportsTeam\]\] can be indicated with a text value of "Mixed".
     *
     * @see http://schema.org/gender
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/gender")
     * @Assert\Type(type="string")
     */
    private ?string $gender = null;

    /**
     * Family name. In the U.S., the last name of a Person.
     *
     * @see http://schema.org/familyName
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/familyName")
     * @Assert\Type(type="string")
     */
    private ?string $familyName = null;

    /**
     * Given name. In the U.S., the first name of a Person.
     *
     * @see http://schema.org/givenName
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/givenName")
     * @Assert\Type(type="string")
     * @Groups({"public"})
     */
    private ?string $givenName = null;

    /**
     * The telephone number.
     *
     * @see http://schema.org/telephone
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/telephone")
     * @Assert\Type(type="string")
     */
    private ?string $telephone = null;

    /**
     * An Organization (or ProgramMembership) to which this Person or Organization belongs.
     *
     * @see http://schema.org/memberOf
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Organization", inversedBy="member")
     * @ApiProperty(iri="http://schema.org/memberOf")
     */
    private ?Organization $memberOf = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setGender(?string $gender): void
    {
        $this->gender = $gender;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setFamilyName(?string $familyName): void
    {
        $this->familyName = $familyName;
    }

    public function getFamilyName(): ?string
    {
        return $this->familyName;
    }

    public function setGivenName(?string $givenName): void
    {
        $this->givenName = $givenName;
    }

    public function getGivenName(): ?string
    {
        return $this->givenName;
    }

    public function setTelephone(?string $telephone): void
    {
        $this->telephone = $telephone;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setMemberOf(?Organization $memberOf): void
    {
        $this->memberOf = $memberOf;
    }

    public function getMemberOf(): ?Organization
    {
        return $this->memberOf;
    }
}
