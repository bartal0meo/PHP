<?php
/**
 * Created by PhpStorm.
 * User: maciej
 * Date: 10.03.17
 * Time: 18:42
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="proposals_consents")
 * */
class ProposalConsent
{
    /**
     * @ORM\Column(type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected $id;
    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Proposal")
     * @ORM\JoinColumn(name="proposal_id", referencedColumnName="id")
     */
    private $proposal_id;
    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="Consent")
     * @ORM\JoinColumn(name="consent_id", referencedColumnName="id")
     */
    private $consent_id;
    /**
     * @var bool
     * @ORM\Column(name="is_checked", type="boolean")
     */
    private $is_checked;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getProposalId()
    {
        return $this->proposal_id;
    }

    /**
     * @param string $proposal_id
     */
    public function setProposalId($proposal_id)
    {
        $this->proposal_id = $proposal_id;
    }

    /**
     * @return int
     */
    public function getConsentId()
    {
        return $this->consent_id;
    }

    /**
     * @param int $consent_id
     */
    public function setConsentId($consent_id)
    {
        $this->consent_id = $consent_id;
    }

    /**
     * @return bool
     */
    public function isIsChecked()
    {
        return $this->is_checked;
    }

    /**
     * @param bool $is_checked
     */
    public function setIsChecked($is_checked)
    {
        $this->is_checked = $is_checked;
    }

}