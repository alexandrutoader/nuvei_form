<?php


namespace App\Dto;


class UserRequestDto
{
    private string $userName;
    private string $password;
    private string $confirmPassword;
    private string $email;
    private string $department;
    private array $categories;
    private array $hobbies;

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     * @return UserRequestDto
     */
    public function setUserName(string $userName): UserRequestDto
    {
        $this->userName = $userName;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return UserRequestDto
     */
    public function setPassword(string $password): UserRequestDto
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getConfirmPassword(): string
    {
        return $this->confirmPassword;
    }

    /**
     * @param string $confirmPassword
     * @return UserRequestDto
     */
    public function setConfirmPassword(string $confirmPassword): UserRequestDto
    {
        $this->confirmPassword = $confirmPassword;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return UserRequestDto
     */
    public function setEmail(string $email): UserRequestDto
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getDepartment(): string
    {
        return $this->department;
    }

    /**
     * @param string $department
     * @return UserRequestDto
     */
    public function setDepartment(string $department): UserRequestDto
    {
        $this->department = $department;
        return $this;
    }

    /**
     * @return array
     */
    public function getCategories(): array
    {
        return $this->categories;
    }

    /**
     * @param array $categories
     * @return UserRequestDto
     */
    public function setCategories(array $categories): UserRequestDto
    {
        $this->categories = $categories;
        return $this;
    }

    /**
     * @return array
     */
    public function getHobbies(): array
    {
        return $this->hobbies;
    }

    /**
     * @param array $hobbies
     * @return UserRequestDto
     */
    public function setHobbies(array $hobbies): UserRequestDto
    {
        $this->hobbies = $hobbies;
        return $this;
    }
}