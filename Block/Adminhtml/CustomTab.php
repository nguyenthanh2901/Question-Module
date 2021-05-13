<?php
namespace AHT\Question\Block\Adminhtml;

use Magento\Customer\Api\AccountManagementInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;

/**
 * Customer Reviews list block
 *
 * @api
 * @since 100.0.2
 */
class CustomTab extends \Magento\Customer\Block\Account\Dashboard
{
     /**
 	* Block template.
 	*
 	* @var string
 	*/
     protected $_template = 'custom_tab.phtml';

    /**
     * Product reviews collection
     *
     * @var \Magento\Review\Model\ResourceModel\Review\Product\Collection
     */
    protected $_collection;
    protected $_answerFactory;
    protected $_answerCollection;
    protected $_answers;
    protected $request;

    /**
     * Review resource model
     *
     * @var \Magento\Review\Model\ResourceModel\Review\Product\CollectionFactory
     */
    protected $_collectionFactory;
    protected $_productRepository;
    protected $_storeManager;
    /**
     * @var \Magento\Customer\Helper\Session\CurrentCustomer
     */
    protected $currentCustomer;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \Magento\Newsletter\Model\SubscriberFactory $subscriberFactory
     * @param CustomerRepositoryInterface $customerRepository
     * @param AccountManagementInterface $customerAccountManagement
     * @param \Magento\Review\Model\ResourceModel\Review\Product\CollectionFactory $collectionFactory
     * @param \Magento\Customer\Helper\Session\CurrentCustomer $currentCustomer
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\App\Request\Http $request,
        \Magento\Newsletter\Model\SubscriberFactory $subscriberFactory,
        CustomerRepositoryInterface $customerRepository,
        AccountManagementInterface $customerAccountManagement,
        \AHT\Question\Model\ResourceModel\Question\CollectionFactory $collectionFactory,
        \AHT\Question\Model\ResourceModel\Answer\Collection $answerFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        \Magento\Customer\Helper\Session\CurrentCustomer $currentCustomer,
        array $data = []
    ) {
        $this->_collectionFactory = $collectionFactory;
        $this->_answerFactory = $answerFactory;
        $this->request = $request;
        $this->_answers = $answerFactory;
        $this->_productRepository = $productRepository;
        $this->_storeManager = $storeManager;
        parent::__construct(
            $context,
            $customerSession,
            $subscriberFactory,
            $customerRepository,
            $customerAccountManagement,
            $data
        );
        $this->currentCustomer = $currentCustomer;
    }
    public function getToolbarHtml()
    {
        return $this->getChildHtml('toolbar');
    }
    /**
     * Get reviews
     *
     * @return bool|\Magento\Review\Model\ResourceModel\Review\Product\Collection
     */
    public function getQuestions()
    {
        if (!$this->_collection) {
            $this->_collection = $this->_collectionFactory->create();
        }
        return $this->_collection->getData();
    }

    public function getAnswers()
    {
        if (!$this->_answers) {
            $this->_answers = $this->_answerFactory->create();
        }
        return $this->_answers->getData();
    }
    public function getIddata()
    {
        $this->request->getParams(); 
        return $this->request->getParam('question_id');
    }
}
