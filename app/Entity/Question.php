<?php
require '../app/Entity/Answer.php';
class Question
{
    private int $id;
    private string $title;
    private int $qcm_id;
    /** @var Answer[] */
    private array $answers;

    /**
     * __construct
     *
     * @param  string $question_title
     * @param  int $question_id
     * @return void
     */
    public function __construct($question_title, $question_id = 0, $qcm_id = 0)
    {
        $this
            ->setTitle($question_title)
            ->setId($question_id)
            ->setQcm_id($qcm_id);

        return $this;
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

    /**
     * Get the value of qcm_id
     */
    public function getQcm_id()
    {
        return $this->qcm_id;
    }

    /**
     * Set the value of qcm_id
     *
     * @return  self
     */
    public function setQcm_id($qcm_id)
    {
        $this->qcm_id = $qcm_id;

        return $this;
    }
}
