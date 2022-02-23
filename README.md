# Magento 2 Product Questions


## 1.Installation instruction:

##### Using Composer
```
composer require royalcybermarketplace/magento2-product-questions

```

### 1.1 - Enable And Install the extension
 * php bin/magento module:enable RoyalCyber_ProductQuestions
 * php bin/magento setup:upgrade
 * php bin/magento setup:di:compile
 * php bin/magento cache:clean

### 1.2 - How to see the results
- Going to the product detail page on frontend, at product tab you can see a tab Question.
- Administrator go to Catalog ->Product questions to see the Questions and Answers
- Shops -> Configuration -> RoyalCyber -> Catalog Product questions to see the configurations of extension.
