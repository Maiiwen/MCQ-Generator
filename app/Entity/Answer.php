<?php

class Answer
{
    private int $id;
    private string $title;
    private bool $isRight;

    public function __construct($array)
    {
        $this->setTitle($array['answer_title']);
        $this->setId($array['answer_id']);
        $this->setIsRight($array['answer_isRight']);
    }

    /**
     * Get the value of Title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of Title
     *
     * @return  self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of isRight
     */
    public function getIsRight()
    {
        return $this->isRight;
    }

    /**
     * Set the value of isRight
     *
     * @return  self
     */
    public function setIsRight($isRight)
    {
        $this->isRight = $isRight;

        return $this;
    }
}
