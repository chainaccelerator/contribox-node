<?php

declare(strict_types=1);
error_reporting(E_ALL);
ini_set("display_errors", "1");
ini_set("log_errors", "1");
$env = 'regtest';
require_once 'conf.php';
require_once 'crypto.php';
require_once 'cryptoHash.php';
require_once 'cryptoPow.php';
require_once 'cryptoSig.php';
require_once 'cryptoWalletFile.php';
require_once 'cryptoWallet.php';
require_once 'cryptoWalletPrivKey.php';
require_once 'cryptoWalletPubKey.php';
require_once 'apiPeer.php';
require_once 'apiPeerTransactionValidator.php';
require_once 'apiPeerBlockValidators.php';
require_once 'apiPeerCertOnMainchainValidator.php';
require_once 'apiPeerDataStore.php';

require_once 'sdkRequest.php';
require_once 'sdkRequestPow.php';
require_once 'sdkRequestSig.php';
require_once 'sdkRequestData.php';
require_once 'sdkRequestRoute.php';
require_once 'sdkWallet.php';
require_once 'sdkHtml.php';
require_once 'sdkTemplate.php';
require_once 'sdkTemplateReferential.php';
require_once 'sdkTemplateReferentialProof.php';
require_once 'sdkTemplateReferentialUser.php';
require_once 'sdkTemplateType.php';
require_once 'sdkTemplateTypeGenesis.php';
require_once 'sdkTemplateTypeApi.php';
require_once 'sdkTemplateTypeInfo.php';
require_once 'sdkTemplateTypeBackup.php';
require_once 'sdkTemplateTypeBan.php';
require_once 'sdkTemplateTypeBlock.php';
require_once 'sdkTemplateTypeBoard.php';
require_once 'sdkTemplateTypeChildstype1.php';
require_once 'sdkTemplateTypeCosigner.php';
require_once 'sdkTemplateTypeCosignerOrg.php';
require_once 'sdkTemplateTypeLock.php';
require_once 'sdkTemplateTypeMember.php';
require_once 'sdkTemplateTypeOld.php';
require_once 'sdkTemplateTypeParentstype1.php';
require_once 'sdkTemplateTypePeg.php';
require_once 'sdkTemplateTypeTo.php';
require_once 'sdkTemplateTypeFrom.php';
require_once 'sdkTemplateTypeWitness.php';
require_once 'sdkTemplateTypeWitnessOrg.php';
require_once 'sdkTemplateTypeInvestorType1.php';
require_once 'sdkTransaction.php';

require_once 'sdkReceive.php';
require_once 'sdkReceiveData.php';
require_once 'sdkReceiveValidation.php';

require_once 'templateCondition.php';
require_once 'templateConditionBackup.php';
require_once 'templateConditionBan.php';
require_once 'templateConditionBoard.php';
require_once 'templateConditionMember.php';
require_once 'templateConditionCosigner.php';
require_once 'templateConditionLock.php';
require_once 'templateConditionMember.php';
require_once 'templateConditionNew.php';
require_once 'templateConditionOld.php';
require_once 'templateConditionUser.php';
require_once 'templateConditionWitness.php';
require_once 'template.php';
require_once 'templateUser.php';
require_once 'templateOrg.php';

require_once 'asset.php';

require_once 'assetTransaction.php';
require_once 'assetTransaction.php';
require_once 'createTransaction.php';
require_once 'proposalTransaction.php';
require_once 'validationTransaction.php';
require_once 'addTransaction.php';

require_once 'assetBlock.php';
require_once 'createBlock.php';
require_once 'proposalBlock.php';
require_once 'validationBlock.php';
require_once 'addBlock.php';

require_once 'assetCertOnMainchain.php';
require_once 'createCertOnMainchain.php';
require_once 'proposalCertOnMainchain.php';
require_once 'validationCertOnMainchain.php';
require_once 'addCertOnMainchain.php';

require_once 'apiRequest.php';
require_once 'apiResponseSuccess.php';
require_once 'apiResponseError.php';
require_once 'apiResponse.php';
require_once 'apiRoute.php';
require_once 'api.php';
require_once 'apiClient.php';


new Conf($env);

