<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'CreativeMail\\Clients\\CreativeMailClient' => $baseDir . '/src/clients/CreativeMailClient.php',
    'CreativeMail\\Constants\\EnvironmentNames' => $baseDir . '/src/constants/EnvironmentNames.php',
    'CreativeMail\\CreativeMail' => $baseDir . '/src/CreativeMail.php',
    'CreativeMail\\Exceptions\\CreativeMailException' => $baseDir . '/src/exceptions/CreativeMailException.php',
    'CreativeMail\\Helpers\\EncryptionHelper' => $baseDir . '/src/helpers/EncryptionHelper.php',
    'CreativeMail\\Helpers\\EnvironmentHelper' => $baseDir . '/src/helpers/EnvironmentHelper.php',
    'CreativeMail\\Helpers\\GuidHelper' => $baseDir . '/src/helpers/GuidHelper.php',
    'CreativeMail\\Helpers\\OptionsHelper' => $baseDir . '/src/helpers/OptionsHelper.php',
    'CreativeMail\\Helpers\\SsoHelper' => $baseDir . '/src/helpers/SsoHelper.php',
    'CreativeMail\\Helpers\\ValidationHelper' => $baseDir . '/src/helpers/ValidationHelper.php',
    'CreativeMail\\Integrations\\Integration' => $baseDir . '/src/integrations/Integration.php',
    'CreativeMail\\Managers\\AdminManager' => $baseDir . '/src/managers/AdminManager.php',
    'CreativeMail\\Managers\\ApiManager' => $baseDir . '/src/managers/ApiManager.php',
    'CreativeMail\\Managers\\CheckoutManager' => $baseDir . '/src/managers/CheckoutManager.php',
    'CreativeMail\\Managers\\DatabaseManager' => $baseDir . '/src/managers/DatabaseManager.php',
    'CreativeMail\\Managers\\EmailManager' => $baseDir . '/src/managers/EmailManager.php',
    'CreativeMail\\Managers\\InstanceManager' => $baseDir . '/src/managers/InstanceManager.php',
    'CreativeMail\\Managers\\IntegrationManager' => $baseDir . '/src/managers/IntegrationManager.php',
    'CreativeMail\\Managers\\RaygunManager' => $baseDir . '/src/managers/RaygunManager.php',
    'CreativeMail\\Modules\\Api\\Models\\ApiRequestItem' => $baseDir . '/src/modules/api/Models/ApiRequestItem.php',
    'CreativeMail\\Modules\\Api\\Processes\\ApiBackgroundProcess' => $baseDir . '/src/modules/api/Processes/ApiBackgroundProcess.php',
    'CreativeMail\\Modules\\Blog\\Models\\BlogAttachment' => $baseDir . '/src/modules/blog/models/BlogAttachment.php',
    'CreativeMail\\Modules\\Blog\\Models\\BlogInformation' => $baseDir . '/src/modules/blog/models/BlogInformation.php',
    'CreativeMail\\Modules\\Blog\\Models\\BlogPost' => $baseDir . '/src/modules/blog/models/BlogPost.php',
    'CreativeMail\\Modules\\Contacts\\Handlers\\BaseContactFormPluginHandler' => $baseDir . '/src/modules/contacts/Handlers/BaseContactFormPluginHandler.php',
    'CreativeMail\\Modules\\Contacts\\Handlers\\BlueHostBuilderPluginHandler' => $baseDir . '/src/modules/contacts/Handlers/BlueHostBuilderPluginHandler.php',
    'CreativeMail\\Modules\\Contacts\\Handlers\\CalderaPluginHandler' => $baseDir . '/src/modules/contacts/Handlers/CalderaPluginHandler.php',
    'CreativeMail\\Modules\\Contacts\\Handlers\\ContactFormSevenPluginHandler' => $baseDir . '/src/modules/contacts/Handlers/ContactFormSevenPluginHandler.php',
    'CreativeMail\\Modules\\Contacts\\Handlers\\ElementorPluginHandler' => $baseDir . '/src/modules/contacts/Handlers/ElementorPluginHandler.php',
    'CreativeMail\\Modules\\Contacts\\Handlers\\FormidablePluginHandler' => $baseDir . '/src/modules/contacts/Handlers/FormidablePluginHandler.php',
    'CreativeMail\\Modules\\Contacts\\Handlers\\GravityFormsPluginHandler' => $baseDir . '/src/modules/contacts/Handlers/GravityFormsPluginHandler.php',
    'CreativeMail\\Modules\\Contacts\\Handlers\\JetpackPluginHandler' => $baseDir . '/src/modules/contacts/Handlers/JetpackPluginHandler.php',
    'CreativeMail\\Modules\\Contacts\\Handlers\\NewsLetterContactFormPluginHandler' => $baseDir . '/src/modules/contacts/Handlers/NewsLetterContactFormPluginHandler.php',
    'CreativeMail\\Modules\\Contacts\\Handlers\\NinjaFormsPluginHandler' => $baseDir . '/src/modules/contacts/Handlers/NinjaFormsPluginHandler.php',
    'CreativeMail\\Modules\\Contacts\\Handlers\\WooCommercePluginHandler' => $baseDir . '/src/modules/contacts/Handlers/WooCommercePluginHandler.php',
    'CreativeMail\\Modules\\Contacts\\Handlers\\WpFormsPluginHandler' => $baseDir . '/src/modules/contacts/Handlers/WpFormsPluginHandler.php',
    'CreativeMail\\Modules\\Contacts\\Managers\\ContactsSyncManager' => $baseDir . '/src/modules/contacts/Managers/ContactsSyncManager.php',
    'CreativeMail\\Modules\\Contacts\\Models\\ContactAddressModel' => $baseDir . '/src/modules/contacts/models/ContactAddressModel.php',
    'CreativeMail\\Modules\\Contacts\\Models\\ContactFormSevenSubmission' => $baseDir . '/src/modules/contacts/models/ContactFormSevenSubmission.php',
    'CreativeMail\\Modules\\Contacts\\Models\\ContactModel' => $baseDir . '/src/modules/contacts/models/ContactModel.php',
    'CreativeMail\\Modules\\Contacts\\Models\\OptActionBy' => $baseDir . '/src/modules/contacts/models/OptActionBy.php',
    'CreativeMail\\Modules\\Contacts\\Processors\\ContactsSyncBackgroundProcessor' => $baseDir . '/src/modules/contacts/Processes/ContactsSyncBackgroundProcessor.php',
    'CreativeMail\\Modules\\Contacts\\Services\\ContactsSyncService' => $baseDir . '/src/modules/contacts/Services/ContactsSyncService.php',
    'CreativeMail\\Modules\\DashboardWidgetModule' => $baseDir . '/src/modules/DashboardWidgetModule.php',
    'CreativeMail\\Modules\\FeedbackNoticeModule' => $baseDir . '/src/modules/FeedbackNoticeModule.php',
    'CreativeMail\\Modules\\WooCommerce\\Models\\WCInformationModel' => $baseDir . '/src/modules/woocommerce/models/WCInformationModel.php',
    'CreativeMail\\Modules\\WooCommerce\\Models\\WCProductModel' => $baseDir . '/src/modules/woocommerce/models/WCProductModel.php',
    'CreativeMail\\Modules\\WooCommerce\\Models\\WCStoreInformation' => $baseDir . '/src/modules/woocommerce/models/WCStoreInformation.php',
    'CreativeMail\\Modules\\Woocommerce\\Emails\\AbandonedCartEmail' => $baseDir . '/src/modules/woocommerce/emails/AbandonedCartEmail.php',
    'CreativeMail\\Modules\\contacts\\Exceptions\\InvalidContactSyncBackgroundRequestException' => $baseDir . '/src/modules/contacts/Exceptions/InvalidContactSyncBackgroundRequestException.php',
    'CreativeMail\\Modules\\contacts\\Exceptions\\InvalidHandlerContactSyncRequestException' => $baseDir . '/src/modules/contacts/Exceptions/InvalidHandlerContactSyncRequestException.php',
    'Defuse\\Crypto\\Core' => $vendorDir . '/defuse/php-encryption/src/Core.php',
    'Defuse\\Crypto\\Crypto' => $vendorDir . '/defuse/php-encryption/src/Crypto.php',
    'Defuse\\Crypto\\DerivedKeys' => $vendorDir . '/defuse/php-encryption/src/DerivedKeys.php',
    'Defuse\\Crypto\\Encoding' => $vendorDir . '/defuse/php-encryption/src/Encoding.php',
    'Defuse\\Crypto\\Exception\\BadFormatException' => $vendorDir . '/defuse/php-encryption/src/Exception/BadFormatException.php',
    'Defuse\\Crypto\\Exception\\CryptoException' => $vendorDir . '/defuse/php-encryption/src/Exception/CryptoException.php',
    'Defuse\\Crypto\\Exception\\EnvironmentIsBrokenException' => $vendorDir . '/defuse/php-encryption/src/Exception/EnvironmentIsBrokenException.php',
    'Defuse\\Crypto\\Exception\\IOException' => $vendorDir . '/defuse/php-encryption/src/Exception/IOException.php',
    'Defuse\\Crypto\\Exception\\WrongKeyOrModifiedCiphertextException' => $vendorDir . '/defuse/php-encryption/src/Exception/WrongKeyOrModifiedCiphertextException.php',
    'Defuse\\Crypto\\File' => $vendorDir . '/defuse/php-encryption/src/File.php',
    'Defuse\\Crypto\\Key' => $vendorDir . '/defuse/php-encryption/src/Key.php',
    'Defuse\\Crypto\\KeyOrPassword' => $vendorDir . '/defuse/php-encryption/src/KeyOrPassword.php',
    'Defuse\\Crypto\\KeyProtectedByPassword' => $vendorDir . '/defuse/php-encryption/src/KeyProtectedByPassword.php',
    'Defuse\\Crypto\\RuntimeTests' => $vendorDir . '/defuse/php-encryption/src/RuntimeTests.php',
    'Firebase\\JWT\\BeforeValidException' => $vendorDir . '/firebase/php-jwt/src/BeforeValidException.php',
    'Firebase\\JWT\\ExpiredException' => $vendorDir . '/firebase/php-jwt/src/ExpiredException.php',
    'Firebase\\JWT\\JWK' => $vendorDir . '/firebase/php-jwt/src/JWK.php',
    'Firebase\\JWT\\JWT' => $vendorDir . '/firebase/php-jwt/src/JWT.php',
    'Firebase\\JWT\\SignatureInvalidException' => $vendorDir . '/firebase/php-jwt/src/SignatureInvalidException.php',
    'Raygun4php\\Raygun4PhpException' => $vendorDir . '/mindscape/raygun4php/src/Raygun4php/Raygun4PhpException.php',
    'Raygun4php\\RaygunClient' => $vendorDir . '/mindscape/raygun4php/src/Raygun4php/RaygunClient.php',
    'Raygun4php\\RaygunClientMessage' => $vendorDir . '/mindscape/raygun4php/src/Raygun4php/RaygunClientMessage.php',
    'Raygun4php\\RaygunEnvironmentMessage' => $vendorDir . '/mindscape/raygun4php/src/Raygun4php/RaygunEnvironmentMessage.php',
    'Raygun4php\\RaygunExceptionMessage' => $vendorDir . '/mindscape/raygun4php/src/Raygun4php/RaygunExceptionMessage.php',
    'Raygun4php\\RaygunExceptionTraceLineMessage' => $vendorDir . '/mindscape/raygun4php/src/Raygun4php/RaygunExceptionTraceLineMessage.php',
    'Raygun4php\\RaygunIdentifier' => $vendorDir . '/mindscape/raygun4php/src/Raygun4php/RaygunIdentifier.php',
    'Raygun4php\\RaygunMessage' => $vendorDir . '/mindscape/raygun4php/src/Raygun4php/RaygunMessage.php',
    'Raygun4php\\RaygunMessageDetails' => $vendorDir . '/mindscape/raygun4php/src/Raygun4php/RaygunMessageDetails.php',
    'Raygun4php\\RaygunRequestMessage' => $vendorDir . '/mindscape/raygun4php/src/Raygun4php/RaygunRequestMessage.php',
    'WP_Async_Request' => $vendorDir . '/a5hleyrich/wp-background-processing/classes/wp-async-request.php',
    'WP_Background_Process' => $vendorDir . '/a5hleyrich/wp-background-processing/classes/wp-background-process.php',
);
