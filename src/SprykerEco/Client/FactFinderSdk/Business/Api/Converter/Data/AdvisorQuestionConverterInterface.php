<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data;

use FACTFinder\Data\AdvisorAnswer;
use FACTFinder\Data\AdvisorQuestion;

interface AdvisorQuestionConverterInterface
{
    /**
     * @param \FACTFinder\Data\AdvisorQuestion $advisorQuestion
     *
     * @return void
     */
    public function setAdvisorQuestion(AdvisorQuestion $advisorQuestion);

    /**
     * @param \FACTFinder\Data\AdvisorQuestion|null $advisorQuestion
     *
     * @return \Generated\Shared\Transfer\FactFinderSdkDataAdvisorQuestionTransfer
     */
    public function convert($advisorQuestion = null);

    /**
     * @param \FACTFinder\Data\AdvisorAnswer $advisorAnswer
     *
     * @return \Generated\Shared\Transfer\FactFinderSdkDataAdvisorAnswerTransfer
     */
    public function convertAnswer(AdvisorAnswer $advisorAnswer);
}
