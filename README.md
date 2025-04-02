# Orange Money Laravel Package

Ce package Laravel permet d'intégrer le service de paiement Orange Money Web Payment API (Sandbox) dans votre application.

## Installation

Vous pouvez installer ce package via Composer :

```sh
composer require ibradis/orange-money-224
```

Si vous utilisez une installation manuelle dans `vendor`, ajoutez cette ligne dans `composer.json` de votre projet :

```json
"repositories": [
    {
        "type": "path",
        "url": "vendor/ibradis/orange-money-224"
    }
]
```

Ensuite, exécutez :

```sh
composer require ibradis/orange-money
```

## Configuration

Publiez la configuration :

```sh
php artisan vendor:publish --provider="ibradis\OrangeMoney\OrangeMoneyServiceProvider"
```

Puis, ajoutez vos informations Orange Money dans le fichier `.env` :

```ini
ORANGE_CLIENT_ID=your_client_id
ORANGE_CLIENT_SECRET=your_client_secret
ORANGE_MERCHANT_KEY=your_merchant_key
ORANGE_RETURN_URL=https://yourapp.com/success
ORANGE_CANCEL_URL=https://yourapp.com/cancel
ORANGE_NOTIF_URL=https://yourapp.com/notification
```

## Utilisation

### Initialisation du service

Dans votre contrôleur ou service :

```php
use Ibrahima\OrangeMoney\OrangeMoney;

$orangeMoney = new OrangeMoney();
```

### Créer un paiement

```php
$orderId = uniqid();
$amount = 1000;
$reference = 'Commande123';

$response = $orangeMoney->createPayment($orderId, $amount, $reference);
```

### Obtenir un token d'accès

```php
$token = $orangeMoney->getAccessToken();
```

## Licence

Ce projet est sous licence MIT.