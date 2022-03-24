<?php

class Question
{
    private int $id;
    private string $title;
    private array $answers;

    public function __construct($array)
    {
        $this->setTitle($array['question_title']);
        $this->setId($array['question_id']);
    }
    /**
     * Get the value of answers
     * 
     * @return array $answers
     */

    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * Add an Answer
     * @param Answer $answer
     * @return  self
     */
    public function addAnswers(Answer $answer)
    {
        $this->answers[] = $answer;

        return $this;
    }

    /**
     * Get the value of question
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of question
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
}
