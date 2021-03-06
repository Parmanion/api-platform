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
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\JoinColumn;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A rating is an evaluation on a numeric scale, such as 1 to 5 stars.
 *
 * @see http://schema.org/Rating
 *
 * @author Pierre Pailley
 *
 * @ORM\Entity
 * @ApiResource(iri="http://schema.org/Rating")
 */
class Rating
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
     * The rating for the content.\\n\\nUsage guidelines:\\n\\n\* Use values from 0123456789 (Unicode 'DIGIT ZERO' (U+0030) to 'DIGIT NINE' (U+0039)) rather than superficially similiar Unicode symbols.\\n\* Use '.' (Unicode 'FULL STOP' (U+002E)) rather than ',' to indicate a decimal point. Avoid using these symbols as a readability separator.
     *
     * @see http://schema.org/ratingValue
     *
     * @ORM\Column(type="smallint", nullable=false, length=1)
     * @ApiProperty(iri="http://schema.org/ratingValue")
     * @Assert\Type(type="int")
     */
    private ?string $ratingValue = null;

    /**
     * A short explanation (e.g. one to two sentences) providing background context and other information that led to the conclusion expressed in the rating. This is particularly applicable to ratings associated with "fact check" markup using ClaimReview.
     *
     * @see http://schema.org/ratingExplanation
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/ratingExplanation")
     * @Assert\Type(type="string")
     */
    private ?string $ratingExplanation = null;

    /**
     * The author of this content or rating. Please note that author is special in that HTML 5 provides a special mechanism for indicating authorship via the rel tag. That is equivalent to this and may be used interchangeably.
     *
     * @see http://schema.org/author
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ApiProperty(iri="http://schema.org/author")
     */
    private ?User $author = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setRatingValue(?string $ratingValue): void
    {
        $this->ratingValue = $ratingValue;
    }

    public function getRatingValue(): ?string
    {
        return $this->ratingValue;
    }

    public function setAuthor(?User $author): void
    {
        $this->author = $author;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function getRatingExplanation(): ?string
    {
        return $this->ratingExplanation;
    }

    public function setRatingExplanation(?string $ratingExplanation): void
    {
        $this->ratingExplanation = $ratingExplanation;
    }

    public function getSubjectOf(): ?Service
    {
        return $this->subjectOf;
    }

    public function setSubjectOf(?Service $subjectOf): void
    {
        $this->subjectOf = $subjectOf;
    }

}
