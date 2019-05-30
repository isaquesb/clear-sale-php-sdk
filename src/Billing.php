<?php
namespace ClearSale;

class Billing extends Entity
{
    const GENDER_MALE = 'M';
    const GENDER_FEMALE = 'F';

    const PERSON_NATURAL = 1;
    const PERSON_LEGAL = 2;

    /**
     * @var string
     */
    protected $clientID;

    /**
     * @var int
     */
    protected $type;

    /**
     * @var string
     */
    protected $primaryDocument;

    /**
     * @var string
     */
    protected $secondaryDocument;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var \DateTime
     */
    protected $birthDate;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $gender;

    /**
     * @var Address
     */
    protected $address;

    /**
     * @var Phone[]
     */
    protected $phones;

    /**
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->asDateTimeVal($this->birthDate);
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->asInteger($this->type);
    }

    /**
     * @param string $gender
     */
    public function setGender($gender)
    {
        $gender = strtoupper($gender);
        if ($gender !== self::GENDER_MALE && $gender !== self::GENDER_FEMALE) {
            throw new \InvalidArgumentException('Invalid gender: ' . $gender);
        }
        $this->gender = $gender;
    }

    /**
     * @param int $type
     */
    public function setType($type)
    {
        if ($type !== self::PERSON_NATURAL && $type !== self::PERSON_LEGAL) {
            throw new \InvalidArgumentException('Invalid Person Type: ' . $type);
        }
        $this->type = $type;
    }

    /**
     * @param Address $address
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;
    }

    /**
     * @param Phone[] $phones
     */
    public function setPhones(array $phones)
    {
        foreach ($phones as $phone) {
            if (!($phone instanceof Phone)) {
                throw new \UnexpectedValueException('Invalid Phone Object');
            }
        }
        $this->phones = $phones;
    }
}
