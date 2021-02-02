<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data;

use FACTFinder\Data\AdvisorAnswer;
use FACTFinder\Data\AdvisorQuestion;
use Generated\Shared\Transfer\FactFinderSdkDataAdvisorAnswerTransfer;
use Generated\Shared\Transfer\FactFinderSdkDataAdvisorQuestionTransfer;
use SprykerEco\Client\FactFinderSdk\Business\Api\Converter\BaseConverter;

class AdvisorQuestionConverter extends BaseConverter implements AdvisorQuestionConverterInterface
{
    /**
     * @var \FACTFinder\Data\AdvisorQuestion
     */
    protected $advisorQuestion;

    /**
     * @var \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\ItemConverterInterface
     */
    protected $itemConverter;

    /**
     * @param \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\ItemConverterInterface $itemConverter
     */
    public function __construct(ItemConverterInterface $itemConverter)
    {
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
     * @return \Generated\Shared\Transfer\FactFinderSdkDataAdvisorQuestionTransfer
     */
    public function convert($advisorQuestion = null)
    {
        $advisorQuestion = $advisorQuestion === null ? $advisorQuestion : $this->advisorQuestion;
        $factFinderDataAdvisorQuestionTransfer = new FactFinderSdkDataAdvisorQuestionTransfer();
        $factFinderDataAdvisorQuestionTransfer->setText($advisorQuestion->getText());

        if ($advisorQuestion->hasAnswers()) {
            foreach ($advisorQuestion->getAnswers() as $advisorAnswer) {
                $factFinderDataAdvisorQuestionTransfer->addAdvisorAnswer(
                    $this->convertAnswer($advisorAnswer)
                );
            }
        }

        return $factFinderDataAdvisorQuestionTransfer;
    }

    /**
     * @param \FACTFinder\Data\AdvisorAnswer $advisorAnswer
     *
     * @return \Generated\Shared\Transfer\FactFinderSdkDataAdvisorAnswerTransfer
     */
    public function convertAnswer(AdvisorAnswer $advisorAnswer)
    {
        $factFinderDataAdvisorAnswerTransfer = new FactFinderSdkDataAdvisorAnswerTransfer();
        $factFinderDataAdvisorAnswerTransfer->setText($advisorAnswer->getText());
        $factFinderDataAdvisorAnswerTransfer->setUrl($advisorAnswer->getUrl());
        $this->itemConverter->setItem($advisorAnswer);
        $factFinderDataAdvisorAnswerTransfer->setItem(
            $this->itemConverter->convert()
        );

        if ($advisorAnswer->hasFollowUpQuestions()) {
            foreach ($advisorAnswer->getFollowUpQuestions() as $followUpQuestion) {
                $factFinderDataAdvisorAnswerTransfer->addFollowUpQuestion(
                    $this->convert($followUpQuestion)
                );
            }
        }

        return $factFinderDataAdvisorAnswerTransfer;
    }
}
