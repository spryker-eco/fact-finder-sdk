<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Client\FactFinderSdk\Business\Api\Converter;

use FACTFinder\Adapter\ProductCampaign as FactFinderProductCampaign;
use Generated\Shared\Transfer\FactFinderSdkDataCampaignIteratorTransfer;
use Generated\Shared\Transfer\FactFinderSdkDataCampaignTransfer;
use Generated\Shared\Transfer\FactFinderSdkProductCampaignResponseTransfer;
use SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\AdvisorQuestionConverter;
use SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\RecordConverter;

class ProductCampaignResponseConverter extends BaseConverter
{
    /**
     * @var \FACTFinder\Adapter\ProductCampaign
     */
    protected $productCampaignAdapter;

    /**
     * @var \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\RecordConverter
     */
    protected $recordConverter;

    /**
     * @var \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\AdvisorQuestionConverter
     */
    protected $advisorQuestionConverter;

    /**
     * ProductCampaignResponseConverter constructor.
     *
     * @param \FACTFinder\Adapter\ProductCampaign $productCampaignAdapter
     * @param \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\RecordConverter $recordConverter
     * @param \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\AdvisorQuestionConverter $advisorQuestionConverter
     */
    public function __construct(
        FactFinderProductCampaign $productCampaignAdapter,
        RecordConverter $recordConverter,
        AdvisorQuestionConverter $advisorQuestionConverter
    ) {
        $this->productCampaignAdapter = $productCampaignAdapter;
        $this->recordConverter = $recordConverter;
        $this->advisorQuestionConverter = $advisorQuestionConverter;
    }

    /**
     * @return \Generated\Shared\Transfer\FactFinderSdkProductCampaignResponseTransfer
     */
    public function convert()
    {
        $responseTransfer = new FactFinderSdkProductCampaignResponseTransfer();

        $responseTransfer->setCampaignIterator(
            $this->convertCampaigns($this->productCampaignAdapter->getCampaigns())
        );

        return $responseTransfer;
    }

    /**
     * @param \FACTFinder\Data\CampaignIterator $campaigns
     *
     * @return \Generated\Shared\Transfer\FactFinderSdkDataCampaignIteratorTransfer
     */
    protected function convertCampaigns($campaigns)
    {
        $factFinderDataCampaignIteratorTransfer = new FactFinderSdkDataCampaignIteratorTransfer();
        $factFinderDataCampaignIteratorTransfer->setHasRedirect($campaigns->hasRedirect());
        $factFinderDataCampaignIteratorTransfer->setRedirectUrl($campaigns->getRedirectUrl());
        $factFinderDataCampaignIteratorTransfer->setHasFeedback($campaigns->hasFeedback());
//        $factFinderDataCampaignIteratorTransfer->setFeedback($campaigns->getFeedback());
        $factFinderDataCampaignIteratorTransfer->setHasPushedProducts($campaigns->hasPushedProducts());
        /** @var \FACTFinder\Data\Record $pushedProduct */
        foreach ($campaigns->getPushedProducts() as $pushedProduct) {
            $this->recordConverter->setRecord($pushedProduct);
            $factFinderDataCampaignIteratorTransfer->addPushedProducts(
                $this->recordConverter->convert()
            );
        }
        $factFinderDataCampaignIteratorTransfer->setHasActiveQuestions($campaigns->hasActiveQuestions());
        /** @var \FACTFinder\Data\Record $activeQuestion */
        foreach ($campaigns->getActiveQuestions() as $activeQuestion) {
            $this->recordConverter->setRecord($activeQuestion);
            $factFinderDataCampaignIteratorTransfer->addGetActiveQuestions(
                $this->recordConverter->convert()
            );
        }
        $factFinderDataCampaignIteratorTransfer->setHasAdvisorTree($campaigns->hasAdvisorTree());
        /** @var \FACTFinder\Data\Record $advisorTree */
        foreach ($campaigns->getAdvisorTree() as $advisorTree) {
            $this->recordConverter->setRecord($advisorTree);
            $factFinderDataCampaignIteratorTransfer->addAdvisorTree(
                $this->recordConverter->convert()
            );
        }

        /** @var \FACTFinder\Data\Campaign $campaign */
        foreach ($campaigns as $campaign) {
            $factFinderDataCampaignTransfer = new FactFinderSdkDataCampaignTransfer();
            $factFinderDataCampaignTransfer->setName($campaign->getName());
            $factFinderDataCampaignTransfer->setCategory($campaign->getCategory());
            $factFinderDataCampaignTransfer->setRedirectUrl($campaign->getRedirectUrl());
            $factFinderDataCampaignTransfer->setFeedback($campaign->getFeedbackArray());
            $factFinderDataCampaignTransfer->setHasRedirect($campaign->hasRedirect());
            $factFinderDataCampaignTransfer->setHasPushedProducts($campaign->hasPushedProducts());
            /** @var \FACTFinder\Data\Record $pushedProduct */
            foreach ($campaign->getPushedProducts() as $pushedProduct) {
                $this->recordConverter->setRecord($pushedProduct);
                $factFinderDataCampaignTransfer->addPushedProducts(
                    $this->recordConverter->convert()
                );
            }
            /** @var \FACTFinder\Data\AdvisorQuestion $activeQuestion */
            foreach ($campaign->getActiveQuestions() as $activeQuestion) {
                $this->advisorQuestionConverter->setAdvisorQuestion($activeQuestion);
                $factFinderDataCampaignTransfer->addActiveQuestions(
                    $this->advisorQuestionConverter->convert()
                );
            }
            /** @var \FACTFinder\Data\AdvisorQuestion $advisorTree */
            foreach ($campaign->getAdvisorTree() as $advisorTree) {
                $this->advisorQuestionConverter->setAdvisorQuestion($advisorTree);
                $factFinderDataCampaignTransfer->addAdvisorTree(
                    $this->advisorQuestionConverter->convert()
                );
            }

            $factFinderDataCampaignIteratorTransfer->addCampaigns($factFinderDataCampaignTransfer);
        }

        return $factFinderDataCampaignIteratorTransfer;
    }
}
