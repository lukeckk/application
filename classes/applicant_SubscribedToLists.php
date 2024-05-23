<?php

class Applicant_SubscribedToLists extends Applicant
{
    private $_selectionsJobs = [];
    private $_selectionsVerticals = [];

    /**
     * @return array
     */
    public function getSelectionsJobs()
    {
        return $this->_selectionsJobs;
    }

    /**
     * @param array $selectionsJobs
     */
    public function setSelectionsJobs(array $selectionsJobs)
    {
        $this->_selectionsJobs = $selectionsJobs;
    }

    /**
     * @return array
     */
    public function getSelectionsVerticals()
    {
        return $this->_selectionsVerticals;
    }

    /**
     * @param array $selectionsVerticals
     */
    public function setSelectionsVerticals(array $selectionsVerticals)
    {
        $this->_selectionsVerticals = $selectionsVerticals;
    }


    /**
     * @return mixed|string
     */
    public function getFname()
    {
        return $this->_fname;
    }

    /**
     * @param mixed|string $fname
     */
    public function setFname($fname)
    {
        $this->_fname = $fname;
    }

    /**
     * @return mixed|string
     */
    public function getLname()
    {
        return $this->_lname;
    }

    /**
     * @param mixed|string $lname
     */
    public function setLname($lname)
    {
        $this->_lname = $lname;
    }

    /**
     * @return mixed|string
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param mixed|string $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return mixed|string
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * @param mixed|string $state
     */
    public function setState($state)
    {
        $this->_state = $state;
    }

    /**
     * @return mixed|string
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * @param mixed|string $phone
     */
    public function setPhone($phone)
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
    public function setGithub($github)
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
    public function setExperience($experience)
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
    public function setRelocate($relocate)
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
    public function setBio($bio)
    {
        $this->_bio = $bio;
    }


}