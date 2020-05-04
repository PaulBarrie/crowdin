<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TranslationRepository")
 */
class Translation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=55)
     */
    private $lang;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $translate_content;


    /**
     * @ORM\Column(type="integer")
     */
    private $translator_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Source", inversedBy="translations")
     */
    private $source;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLang(): ?string
    {
        return $this->lang;
    }

    public function setLang(string $lang): self
    {
        $this->lang = $lang;

        return $this;
    }

    public function getTranslateContent(): ?string
    {
        return $this->translate_content;
    }

    public function setTranslateContent(string $translate_content): self
    {
        $this->translate_content = $translate_content;

        return $this;
    }

    public function getTranslatorId(): ?int
    {
        return $this->translator_id;
    }

    public function setTranslatorId(int $translator_id): self
    {
        $this->translator_id = $translator_id;

        return $this;
    }

    public function getSource(): ?Source
    {
        return $this->source;
    }

    public function setSource(?Source $source): self
    {
        $this->source = $source;

        return $this;
    }
}
