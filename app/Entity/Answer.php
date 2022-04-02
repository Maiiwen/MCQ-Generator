<?php

class Answer
{
    private int $id;
    private string $title;
    private bool $isRight;


    /**
     * __construct
     *
     * @param  string $answer_title
     * @param  bool $answer_isRight
     * @param  int $answer_id
     * @return void
     */
    public function __construct($answer_title, $answer_isRight, $answer_id = 0)
    {
        $this
            ->setTitle($answer_title)
            ->setId($answer_id)
            ->setIsRight($answer_isRight);
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
     * @param bool $isRight
     * @return  self
     */
    public function setIsRight($isRight)
    {
        $this->isRight = $isRight;

        return $this;
    }
}
