<?php
class Applicant
{
    private $_fname;
    private $_lname;
    private $_email;
    private $_state;
    private $_phone;
    private $_github;
    private $_experience;
    private $_relocate;
    private $_bio;

    /**
     * @param $_fname
     * @param $_lname
     * @param $_email
     * @param $_state
     * @param $_phone
     */
    public function __construct($_fname="", $_lname="", $_email="", $_state="", $_phone="")
    {
        $this->_fname = $_fname;
        $this->_lname = $_lname;
        $this->_email = $_email;
        $this->_state = $_state;
        $this->_phone = $_phone;
    }

    /**
     * @return mixed|string
     */
    public function getFname(): mixed
    {
        return $this->_fname;
    }

    /**
     * @param mixed|string $fname
     */
    public function setFname(mixed $fname): void
    {
        $this->_fname = $fname;
    }

    /**
     * @return mixed|string
     */
    public function getLname(): mixed
    {
        return $this->_lname;
    }

    /**
     * @param mixed|string $lname
     */
    public function setLname(mixed $lname): void
    {
        $this->_lname = $lname;
    }

    /**
     * @return mixed|string
     */
    public function getEmail(): mixed
    {
        return $this->_email;
    }

    /**
     * @param mixed|string $email
     */
    public function setEmail(mixed $email): void
    {
        $this->_email = $email;
    }

    /**
     * @return mixed|string
     */
    public function getState(): mixed
    {
        return $this->_state;
    }

    /**
     * @param mixed|string $state
     */
    public function setState(mixed $state): void
    {
        $this->_state = $state;
    }

    /**
     * @return mixed|string
     */
    public function getPhone(): mixed
    {
        return $this->_phone;
    }

    /**
     * @param mixed|string $phone
     */
    public function setPhone(mixed $phone): void
    {
        $this->_phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getGithub()
    {
        return $this->_github;
    }

    /**
     * @param mixed $github
     */
    public function setGithub($github): void
    {
        $this->_github = $github;
    }

    /**
     * @return mixed
     */
    public function getExperience()
    {
        return $this->_experience;
    }

    /**
     * @param mixed $experience
     */
    public function setExperience($experience): void
    {
        $this->_experience = $experience;
    }

    /**
     * @return mixed
     */
    public function getRelocate()
    {
        return $this->_relocate;
    }

    /**
     * @param mixed $relocate
     */
    public function setRelocate($relocate): void
    {
        $this->_relocate = $relocate;
    }

    /**
     * @return mixed
     */
    public function getBio()
    {
        return $this->_bio;
    }

    /**
     * @param mixed $bio
     */
    public function setBio($bio): void
    {
        $this->_bio = $bio;
    }




}