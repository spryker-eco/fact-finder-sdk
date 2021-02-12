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
use SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\AdvisorQuestionConverterInterface;
use SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\RecordConverterInterface;

class ProductCampaignResponseConverter extends BaseConverter implements ConverterInterface
{
    /**
     * @var \FACTFinder\Adapter\ProductCampaign
     */
    protected $productCampaignAdapter;

    /**
     * @var \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\RecordConverterInterface
     */
    protected $recordConverter;

    /**
     * @var \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\AdvisorQuestionConverterInterface
     */
    protected $advisorQuestionConverter;

    /**
     * @param \FACTFinder\Adapter\ProductCampaign $productCampaignAdapter
     * @param \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\RecordConverterInterface $recordConverter
     * @param \SprykerEco\Client\FactFinderSdk\Business\Api\Converter\Data\AdvisorQuestionConverterInterface $advisorQuestionConverter
     */
    public function __construct(
        FactFinderProductCampaign $productCampaignAdapter,
        RecordConverterInterface $recordConverter,
        AdvisorQuestionConverterInterface $advisorQuestionConverter
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
        /** @var \FACTFinder\Data\CampaignIterator $campaigns */
        $campaigns = $this->productCampaignAdapter->getCampaigns();

        $responseTransfer->setCampaignIterator(
            $this->convertCampaigns($campaigns)
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
