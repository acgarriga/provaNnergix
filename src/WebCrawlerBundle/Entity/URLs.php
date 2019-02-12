<?php

namespace WebCrawlerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * URLs
 *
 * @ORM\Table(name="u_r_ls")
 * @ORM\Entity(repositoryClass="WebCrawlerBundle\Repository\URLsRepository")
 */
class URLs
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="text")
     */
    private $url;


    /**
     * @var string
     *
     * @ORM\Column(name="headers", type="string")
     */

    private $headers;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set url.
     *
     * @param string $url
     *
     * @return URLs
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set headers.
     *
     * @param array $headers
     *
     * @return URLs
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * Get headers.
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Set idNivell1.
     *
     * @param int $idNivell1
     *
     * @return URLs
     */
    public function setIdNivell1($idNivell1)
    {
        $this->idNivell1 = $idNivell1;

        return $this;
    }

    /**
     * Get idNivell1.
     *
     * @return int
     */
    public function getIdNivell1()
    {
        return $this->idNivell1;
    }
}
