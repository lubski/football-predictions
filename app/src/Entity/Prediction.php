<?php

namespace App\Entity;

use App\Validator\Constraints\StatusTypeInterface;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PredictionRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Validator\Constraints\MarketType as MarketTypeConstraint;
use App\Validator\Constraints\Prediction as PredictionConstraint;
use App\Validator\Constraints\Status as StatusConstraint;

/**
 * @ORM\Entity(repositoryClass=PredictionRepository::class)
 *
 *  @ApiResource(
 *     attributes={"route_prefix"="/v1", "pagination_enabled"=false},
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}},
 *     collectionOperations={"get", "post"},
 *     itemOperations={
 *          "get",
 *          "put"={
 *              "status"=204,
 *              "path"="/prediction/{id}/status",
 *              "denormalization_context"={"groups"={"write-status"}}
 *          }
 *     }
 * )
 * @PredictionConstraint
 */
class Prediction
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned":true})
     * @Groups("read")
     */
    private $id;

    /**
     *
     * @Assert\Type("int")
     * @Assert\Positive
     * @ORM\Column(type="integer", options={"unsigned":true})
     * @Groups({"read", "write"})
     */
    private $eventId;

    /**
     * @Assert\NotBlank
     * @MarketTypeConstraint
     * @ORM\Column(type="enum_market_type")
     * @Groups({"read", "write"})
     */
    private $marketType;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=3)
     * @Groups({"read", "write"})
     */
    private $prediction;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="enum_status", options={"default": "unresolved"})
     * @StatusConstraint
     * @Groups({"read", "write", "write-status"})
     */
    private $status;

    /**
     * @ORM\Column(type="datetime_immutable", options={"default": "CURRENT_TIMESTAMP"})
     * @Groups("read")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     * @Groups("read")
     */
    private $updatedAt;

    public function __construct()
    {
        $this->setCreatedAt(new DateTimeImmutable());
        $this->setUpdatedAt(new DateTime());
        $this->setStatus(StatusTypeInterface::UNRESOLVED);
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEventId(): ?int
    {
        return $this->eventId;
    }

    public function setEventId(int $eventId): self
    {
        $this->eventId = $eventId;

        return $this;
    }

    public function getMarketType(): ?string
    {
        return $this->marketType;
    }

    public function setMarketType(string $marketType): self
    {
        $this->marketType = $marketType;

        return $this;
    }

    public function getPrediction(): ?string
    {
        return $this->prediction;
    }

    public function setPrediction(string $prediction): self
    {
        $this->prediction = $prediction;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
