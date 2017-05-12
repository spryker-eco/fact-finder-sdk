<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderApi\Business\Api\Converter\Data;

use FACTFinder\Data\AdvisorAnswer;
use FACTFinder\Data\AdvisorQuestion;
use Generated\Shared\Transfer\FactFinderApiDataAdvisorAnswerTransfer;
use Generated\Shared\Transfer\FactFinderApiDataAdvisorQuestionTransfer;
use SprykerEco\Client\FactFinderApi\Business\Api\Converter\BaseConverter;

class AdvisorQuestionConverter extends BaseConverter
{

    /**
     * @var \FACTFinder\Data\AdvisorQuestion
     */
    protected $advisorQuestion;

    /**
     * @var \SprykerEco\Client\FactFinderApi\Business\Api\Converter\Data\ItemConverter
     */
    protected $itemConverter;

    /**
     * @param \SprykerEco\Client\FactFinderApi\Business\Api\Converter\Data\ItemConverter $itemConverter
     */
    public function __construct(
        ItemConverter $itemConverter
    ) {
        $this->itemConverter = $itemConverter;
    }

    /**
     * @param \FACTFinder\Data\AdvisorQuestion $advisorQuestion
     *
     * @return void
     */
    public function setAdvisorQuestion(AdvisorQuestion $advisorQuestion)
    {
        $this->advisorQuestion = $advisorQuestion;
    }

    /**
     * @param \FACTFinder\Data\AdvisorQuestion|null $advisorQuestion
     *
     * @return \Generated\Shared\Transfer\FactFinderApiDataAdvisorQuestionTransfer
     */
    public function convert($advisorQuestion = null)
    {
        $advisorQuestion = $advisorQuestion === null?$advisorQuestion:$this->advisorQuestion;
        $factFinderDataAdvisorQuestionTransfer = new FactFinderApiDataAdvisorQuestionTransfer();
        $factFinderDataAdvisorQuestionTransfer->setText($advisorQuestion->getText());

        if ($advisorQuestion->hasAnswers()) {
            foreach ($advisorQuestion->getAnswers() as $advisorAnswer) {
                $factFinderDataAdvisorQuestionTransfer->addAdvisorAnswers(
                    $this->convertAnswer($advisorAnswer)
                );
            }
        }

        return $factFinderDataAdvisorQuestionTransfer;
    }

    /**
     * @param \FACTFinder\Data\AdvisorAnswer $advisorAnswer
     *
     * @return \Generated\Shared\Transfer\FactFinderApiDataAdvisorAnswerTransfer
     */
    public function convertAnswer(AdvisorAnswer $advisorAnswer)
    {
        $factFinderDataAdvisorAnswerTransfer = new FactFinderApiDataAdvisorAnswerTransfer();
        $factFinderDataAdvisorAnswerTransfer->setText($advisorAnswer->getText());
        $this->itemConverter->setItem($advisorAnswer);
        $factFinderDataAdvisorAnswerTransfer->setItem(
            $this->itemConverter->convert()
        );

        if ($advisorAnswer->hasFollowUpQuestions()) {
            foreach ($advisorAnswer->getFollowUpQuestions() as $followUpQuestion) {
                $factFinderDataAdvisorAnswerTransfer->addFollowUpQuestions(
                    $this->convert($followUpQuestion)
                );
            }
        }

        return $factFinderDataAdvisorAnswerTransfer;
    }

}
