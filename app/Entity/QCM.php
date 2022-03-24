<?php

class QCM
{
    private int $id;
    private string $title;
    private array $questions;

    /**
     * Get the value of questions
     * 
     * @return array $questions
     */
    public function __construct($array)
    {
        $this->setTitle($array['qcm_title'])->setId($array['qcm_id']);
    }
    public function getQuestions()
    {
        return $this->questions;
    }
    /**
     * Add a question
     * @param Question $question
     * @return  Question
     */
    public function addQuestions(Question $question)
    {
        $this->questions[] = $question;
        return $this->questions[sizeof($this->questions) - 1];
    }

    public function show()
    {
        include '../app/includes/show.php';
    }

    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
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
